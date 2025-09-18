<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClusterModel;
use App\Models\DetailModel;
use App\Models\DetailJamModel;
use App\Models\DurasiModel;
use App\Models\JamModel;
use App\Models\RegistrasiModel;
use App\Models\DiveSpotModel;
use App\Models\UserModel;
use Dompdf\Dompdf;

class Registrasi extends BaseController
{
    protected $clusterModel;
    protected $detailModel;
    protected $detailJamModel;
    protected $durasiModel;
    protected $jamModel;
    protected $registrasiModel;
    protected $diveSpotModel;
    protected $cart;
    protected $session;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->clusterModel = new ClusterModel();
        $this->detailModel = new DetailModel();
        $this->detailJamModel = new DetailJamModel();
        $this->durasiModel = new DurasiModel();
        $this->jamModel = new JamModel();
        $this->registrasiModel = new RegistrasiModel();
        $this->diveSpotModel = new DiveSpotModel();

        $this->session = session();
        $this->cart = service('cart');
    }

    public function index()
    {
        $data = [
            'jml_penumpang' => $this->session->get('jml_penumpang') ?? '',
            'dokumen' => $this->session->get('dokumen') ?? '',
            'cluster' => $this->clusterModel->findAll(),
            'jam' => $this->jamModel->findAll(),
            'detail' => $this->cart->contents(),
        ];

        return view('registrasi', $data);
    }

    public function proses()
    {
        $params = [
            'jml_penumpang' => $this->request->getPost('jml_penumpang') ?? '',
        ];

        $file = $this->request->getFile('dokumen');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $old = $this->session->get('dokumen');
            if (!empty($old) && file_exists(FCPATH . 'uploads/dokumen/' . $old)) {
                unlink(FCPATH . 'uploads/dokumen/' . $old);
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/dokumen/', $newName);
            $params['dokumen'] = $newName;
        }

        $this->session->set($params);
        return redirect()->to('registrasi');
    }

    public function proses2()
    {
        $cluster_id = $this->request->getPost('cluster_id');
        $tanggal = $this->request->getPost('tanggal');
        $dive_spot_id = $this->request->getPost('dive_spot_id') ?? [];
        $jam_id = $this->request->getPost('jam_id') ?? [];

        if (empty($cluster_id) || empty($tanggal) || empty($dive_spot_id) || empty($jam_id)) {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data cluster, tanggal, dive spot, dan jam harus diisi
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            return redirect()->to('registrasi');
        }

        $cluster = $this->clusterModel->find($cluster_id);
        $dive_spot = $this->diveSpotModel->find($dive_spot_id[0]);

        $nama_jam = [];
        foreach ($jam_id as $row) {
            $jam = $this->jamModel->find($row);
            $nama_jam[] = $jam['nama_jam'];
        }

        $params = [
            'dive_spot_id' => $dive_spot_id[0],
            'nama_dive_spot' => $dive_spot['nama_dive_spot'],
            'jam_id' => $jam_id,
            'nama_jam' => $nama_jam,
            'tanggal' => $tanggal,
        ];

        $data = [
            'id' => $cluster_id,
            'qty' => 1,
            'price' => 0,
            'name' => $cluster['nama_cluster'],
            'options' => $params,
        ];

        $this->cart->insert($data);
        return redirect()->to('registrasi');
    }

    public function hapus($rowid)
    {
        $this->cart->remove($rowid);
        return redirect()->to('registrasi');
    }

    public function simpan()
    {
        $detail = $this->cart->contents();

        // Cek bentrok booking
        foreach ($detail as $row) {
            foreach ($row['options']['jam_id'] as $jam_id) {
                $existingShips = $this->detailModel->countExistingShips(
                    $row['id'],
                    $row['options']['tanggal'],
                    $row['options']['dive_spot_id'],
                    $jam_id
                );

                if ($existingShips >= 1) {
                    $cluster = $this->clusterModel->find($row['id']);
                    $dive_spot = $this->diveSpotModel->find($row['options']['dive_spot_id']);
                    $jam = $this->jamModel->find($jam_id);

                    $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Tanggal ' . $row['options']['tanggal'] . ' di ' . $cluster['nama_cluster'] . ' pada dive spot \'' . $dive_spot['nama_dive_spot'] . '\' jam ' . $jam['nama_jam'] . ' sudah ada yang booking
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');

                    return redirect()->to('registrasi');
                }
            }
        }

        $params_reg = [
            'user_id' => $this->session->get('id'),
            'jml_penumpang' => $this->session->get('jml_penumpang') ?? '',
            'dokumen' => $this->session->get('dokumen') ?? '',
            'tgl_registrasi' => date('Y-m-d H:i:s'),
        ];

        $registrasi_id = $this->registrasiModel->insert($params_reg);

        $processedClusters = [];
        foreach ($detail as $row) {
            $params_detail = [
                'registrasi_id' => $registrasi_id,
                'cluster_id' => $row['id'],
                'tanggal' => $row['options']['tanggal'],
                'dive_spot_id' => $row['options']['dive_spot_id'],
            ];

            $detail_id = $this->detailModel->insert($params_detail);

            foreach ($row['options']['jam_id'] as $jam_id) {
                $params_detail_jam = [
                    'detail_id' => $detail_id,
                    'jam_id' => $jam_id,
                ];
                $this->detailJamModel->insert($params_detail_jam);
            }

            if (!in_array($row['id'], $processedClusters)) {
                $startDate = strtotime($row['options']['tanggal']);
                $endDate   = strtotime('+2 days', $startDate);

                for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                    $params_durasi = [
                        'registrasi_id' => $registrasi_id,
                        'cluster_id' => $row['id'],
                        'tanggal' => date('Y-m-d', $currentDate),
                    ];
                    $this->durasiModel->insert($params_durasi);
                }

                $processedClusters[] = $row['id'];
            }
        }

        $this->cart->destroy();
        $this->session->remove(['jml_penumpang', 'dokumen']);

        $this->session->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Registrasi berhasil, tanda bukti registrasi sudah dikirimkan ke email Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        // Kirim email dengan PDF
        $pdf_file_path = $this->pdf($registrasi_id);

        $user = model(UserModel::class)->find(session('id'));

        $email = \Config\Services::email();
        $email->setFrom('admin.sispandalwas@gmail.com', 'SISPANDALWAS');
        $email->setTo($user['email']);
        $email->setSubject('Tanda Bukti Registrasi');
        $email->setMessage('Berikut ini adalah tanda bukti registrasi Anda.');
        $email->attach($pdf_file_path);

        if ($email->send()) {
            unlink($pdf_file_path);
        } else {
            log_message('error', 'Email sending failed: ' . $email->printDebugger());
        }

        return redirect()->to('registrasi');
    }

    public function reset()
    {
        $this->cart->destroy();

        $dokumen = $this->session->get('dokumen');
        if (!empty($dokumen) && file_exists(FCPATH . 'uploads/dokumen/' . $dokumen)) {
            unlink(FCPATH . 'uploads/dokumen/' . $dokumen);
        }

        $this->session->remove(['jml_penumpang', 'dokumen']);
        return redirect()->to('registrasi');
    }

    public function getDiveSpot()
    {
        $cluster_id = $this->request->getPost('cluster_id');
        $data = $this->diveSpotModel->where('cluster_id', $cluster_id)
            ->where('aktif', 1)
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function getDurasiCluster()
    {
        $cluster_id = $this->request->getPost('cluster_id');
        $detail = $this->cart->contents();

        $tanggal = '';
        foreach ($detail as $row) {
            if ($row['id'] == $cluster_id) {
                $tanggal = $row['options']['tanggal'];
                break;
            }
        }

        if (!empty($tanggal)) {
            $startDate = strtotime($tanggal);
            $endDate = strtotime('+2 days', $startDate);

            return $this->response->setJSON([
                'start_date' => date('Y-m-d', $startDate),
                'end_date' => date('Y-m-d', $endDate),
            ]);
        } else {
            return $this->response->setJSON([
                'start_date' => '',
                'end_date'   => '',
            ]);
        }
    }

    public function getJam()
    {
        $cluster_id = $this->request->getPost('cluster_id');
        $tanggal = $this->request->getPost('tanggal');
        $dive_spot_id = $this->request->getPost('dive_spot_id');

        $detail = $this->detailModel->getDetail($cluster_id, $tanggal, $dive_spot_id);

        $result = [];
        foreach ($detail as $row) {
            $detail_jam = $this->detailJamModel->getJam($row['id']);
            foreach ($detail_jam as $row2) {
                $result[] = $row2['jam_id'];
            }
        }

        $result = array_unique($result);

        $detail_cart = $this->cart->contents();
        foreach ($detail_cart as $row) {
            if ($row['options']['tanggal'] == $tanggal && $row['id'] == $cluster_id && $row['options']['dive_spot_id'] == $dive_spot_id) {
                foreach ($row['options']['jam_id'] as $row2) {
                    $result[] = $row2;
                }
            }
        }

        $result = array_unique($result);
        return $this->response->setJSON($result);
    }

    public function getTotalKapal()
    {
        $cluster_id = $this->request->getPost('cluster_id');
        $durasi = $this->durasiModel->getTotalKapal($cluster_id);

        $max_kapal = 5;
        $result = [];

        foreach ($durasi as $row) {
            if ($row['total'] >= $max_kapal) {
                $result[] = $row['tanggal'];
            }
        }

        return $this->response->setJSON($result);
    }

    public function pdf($registrasi_id)
    {
        $registrasi = $this->registrasiModel->find($registrasi_id);
        $detail = $this->detailModel->findByRegistrasi($registrasi_id);

        $jam = [];
        foreach ($detail as $row) {
            $jam[$row['id']] = [
                'jam' => $this->detailJamModel->getJam($row['id']),
            ];
        }

        $data['registrasi'] = $registrasi;
        $data['user'] = model(UserModel::class)->find($registrasi['user_id']);
        $data['detail'] = $detail;
        $data['jam'] = $jam;

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('registrasi_pdf', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $file_path = FCPATH . 'registrasi_' . date('YmdHis') . '.pdf';
        file_put_contents($file_path, $output);

        return $file_path;
    }
}
