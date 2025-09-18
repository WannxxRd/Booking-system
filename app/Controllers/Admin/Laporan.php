<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Reader\Html as HtmlReader;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\ClusterModel;
use App\Models\RegistrasiModel;
use App\Models\DetailModel;
use App\Models\DurasiModel;
use App\Models\DiveSpotModel;
use App\Models\DetailJamModel;

class Laporan extends BaseController
{
    protected $clusterModel;
    protected $registrasiModel;
    protected $detailModel;
    protected $durasiModel;
    protected $diveSpotModel;
    protected $detailJamModel;

    public function __construct()
    {
        $this->clusterModel = new ClusterModel();
        $this->registrasiModel = new RegistrasiModel();
        $this->detailModel = new DetailModel();
        $this->durasiModel = new DurasiModel();
        $this->diveSpotModel = new DiveSpotModel();
        $this->detailJamModel = new DetailJamModel();
    }

    public function index()
    {
        $data['datacluster'] = $this->clusterModel->findAll();

        $cluster = $this->request->getGet('cluster') ?? '';
        $dari    = $this->request->getGet('dari') ?? date('Y-m-d');
        $sampai  = $this->request->getGet('sampai') ?? date('Y-m-d');

        $datacluster = empty($cluster)
            ? $data['datacluster']
            : $this->clusterModel->where('id', $cluster)->findAll();

        $hasil = [];
        foreach ($datacluster as $c) {
            $detail = $this->detailModel->findByIdCluster($c['id']);
            $result = [];

            foreach ($detail as $row) {
                $durasi = $this->durasiModel->getDurasi($c['id'], $row['registrasi_id']);

                $res = [];
                $det2 = $this->detailModel->findByClusterRegistrasi($c['id'], $row['registrasi_id']);
                foreach ($det2 as $row2) {
                    $res[] = [
                        'tgl_masuk' => $row2['tanggal'],
                        'tgl_keluar' => $durasi['tgl_keluar'],
                        'dive_spot' => $this->diveSpotModel->find($row2['dive_spot_id']),
                        'jam' => $this->detailJamModel->getJam($row2['id']),
                    ];
                }

                $registrasi = $this->registrasiModel
                    ->select('registrasi.*, user.nama, user.nama_operator, user.nomor_wa')
                    ->join('user', 'user.id = registrasi.user_id')
                    ->where('registrasi.id', $row['registrasi_id'])
                    ->first();

                $result[] = [
                    'registrasi' => $registrasi,
                    'durasi' => $durasi,
                    'detail' => $res
                ];
            }

            usort($result, fn($a, $b) => $a['durasi']['tgl_masuk'] <=> $b['durasi']['tgl_masuk']);

            $filteredResult = array_values(array_filter($result, function ($row) use ($dari, $sampai) {
                return $row['durasi']['tgl_masuk'] >= $dari && $row['durasi']['tgl_masuk'] <= $sampai;
            }));

            $hasil[] = [
                'cluster' => $c,
                'registrasi' => $filteredResult
            ];
        }

        $total = array_reduce($hasil, fn($carry, $item) => $carry + count($item['registrasi']), 0);

        $data['hasil'] = $hasil;
        $data['total'] = $total;
        $data['cluster'] = $cluster;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        return view('admin/laporan/index', $data);
    }

    public function pdf()
    {
        $data['datacluster'] = $this->clusterModel->findAll();

        $cluster = $this->request->getGet('cluster') ?? '';
        $dari    = $this->request->getGet('dari') ?? '';
        $sampai  = $this->request->getGet('sampai') ?? '';

        $datacluster = empty($cluster)
            ? $data['datacluster']
            : $this->clusterModel->where('id', $cluster)->findAll();

        if (!empty($cluster)) {
            $data['nama_cluster'] = $datacluster[0]['nama_cluster'];
        }

        $hasil = [];
        foreach ($datacluster as $c) {
            $detail = $this->detailModel->findByIdCluster($c['id']);
            $result = [];

            foreach ($detail as $row) {
                $durasi = $this->durasiModel->getDurasi($c['id'], $row['registrasi_id']);

                $res = [];
                $det2 = $this->detailModel->findByClusterRegistrasi($c['id'], $row['registrasi_id']);
                foreach ($det2 as $row2) {
                    $res[] = [
                        'tgl_masuk' => $row2['tanggal'],
                        'tgl_keluar' => $durasi['tgl_keluar'],
                        'dive_spot' => $this->diveSpotModel->find($row2['dive_spot_id']),
                        'jam' => $this->detailJamModel->getJam($row2['id']),
                    ];
                }

                $registrasi = $this->registrasiModel
                    ->select('registrasi.*, user.nama, user.nama_operator, user.nomor_wa')
                    ->join('user', 'user.id = registrasi.user_id')
                    ->where('registrasi.id', $row['registrasi_id'])
                    ->first();

                $result[] = [
                    'registrasi' => $registrasi,
                    'durasi' => $durasi,
                    'detail' => $res
                ];
            }

            usort($result, fn($a, $b) => $a['durasi']['tgl_masuk'] <=> $b['durasi']['tgl_masuk']);

            $filteredResult = array_filter($result, function ($row) use ($dari, $sampai) {
                return $row['durasi']['tgl_masuk'] >= $dari && $row['durasi']['tgl_masuk'] <= $sampai;
            });

            $hasil[] = [
                'cluster' => $c,
                'registrasi' => $filteredResult
            ];
        }

        $data['hasil'] = $hasil;
        $data['total'] = array_reduce($hasil, fn($carry, $item) => $carry + count($item['registrasi']), 0);
        $data['cluster'] = $cluster;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $html = view('admin/laporan/pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setBody($dompdf->output());
    }

    public function excel()
    {
        $data['datacluster'] = $this->clusterModel->findAll();

        $cluster = $this->request->getGet('cluster') ?? '';
        $dari    = $this->request->getGet('dari') ?? '';
        $sampai  = $this->request->getGet('sampai') ?? '';

        $datacluster = empty($cluster)
            ? $data['datacluster']
            : $this->clusterModel->where('id', $cluster)->findAll();

        if (!empty($cluster)) {
            $data['nama_cluster'] = $datacluster[0]['nama_cluster'];
        }

        $hasil = [];
        foreach ($datacluster as $c) {
            $detail = $this->detailModel->findByIdCluster($c['id']);
            $result = [];

            foreach ($detail as $row) {
                $durasi = $this->durasiModel->getDurasi($c['id'], $row['registrasi_id']);

                $res = [];
                $det2 = $this->detailModel->findByClusterRegistrasi($c['id'], $row['registrasi_id']);
                foreach ($det2 as $row2) {
                    $res[] = [
                        'tgl_masuk' => $row2['tanggal'],
                        'tgl_keluar' => $durasi['tgl_keluar'],
                        'dive_spot' => $this->diveSpotModel->find($row2['dive_spot_id']),
                        'jam' => $this->detailJamModel->getJam($row2['id']),
                    ];
                }

                $registrasi = $this->registrasiModel
                    ->select('registrasi.*, user.nama, user.nama_operator, user.nomor_wa')
                    ->join('user', 'user.id = registrasi.user_id')
                    ->where('registrasi.id', $row['registrasi_id'])
                    ->first();

                $result[] = [
                    'registrasi' => $registrasi,
                    'durasi' => $durasi,
                    'detail' => $res
                ];
            }

            usort($result, fn($a, $b) => $a['durasi']['tgl_masuk'] <=> $b['durasi']['tgl_masuk']);

            $filteredResult = array_filter($result, function ($row) use ($dari, $sampai) {
                return $row['durasi']['tgl_masuk'] >= $dari && $row['durasi']['tgl_masuk'] <= $sampai;
            });

            $hasil[] = [
                'cluster' => $c,
                'registrasi' => $filteredResult
            ];
        }

        $data['hasil'] = $hasil;
        $data['total'] = array_reduce($hasil, fn($carry, $item) => $carry + count($item['registrasi']), 0);
        $data['cluster'] = $cluster;
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $html = view('admin/laporan/excel', $data);

        $reader = new HtmlReader();
        $spreadsheet = $reader->loadFromString($html);
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->mergeCells('A1:G1');
        $worksheet->mergeCells('A2:G2');
        $worksheet->getStyle('A1:G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle('A2:G2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->insertNewRowBefore(3, 1);

        $style = [
            'font' => ['size' => 12],
            'alignment' => ['vertical' => Alignment::VERTICAL_TOP],
        ];
        $worksheet->getStyle($worksheet->calculateWorksheetDimension())->applyFromArray($style);

        foreach ($worksheet->getColumnIterator() as $column) {
            $worksheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $worksheet->getStyle('A4:G' . $worksheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        $writer = new Xlsx($spreadsheet);

        return $this->response
            ->setHeader('Content-Type', 'application/vnd.ms-excel')
            ->setHeader('Content-Disposition', 'attachment; filename="laporan-registrasi.xlsx"')
            ->setHeader('Cache-Control', 'max-age=0')
            ->setBody($writer->save('php://output'));
    }
}
