<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegistrasiModel;
use App\Models\DetailModel;
use App\Models\DurasiModel;
use App\Models\DiveSpotModel;
use App\Models\DetailJamModel;
use App\Models\ClusterModel;

class Riwayat extends BaseController
{
    protected $registrasiModel;
    protected $detailModel;
    protected $durasiModel;
    protected $diveSpotModel;
    protected $detailJamModel;
    protected $clusterModel;

    public function __construct()
    {
        $this->registrasiModel = new RegistrasiModel();
        $this->detailModel = new DetailModel();
        $this->durasiModel = new DurasiModel();
        $this->diveSpotModel = new DiveSpotModel();
        $this->detailJamModel = new DetailJamModel();
        $this->clusterModel = new ClusterModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        $cluster = $this->clusterModel->findAll();

        $hasil = [];
        foreach ($cluster as $c) {
            $detail = $this->detailModel
                ->select('detail.*')
                ->join('registrasi', 'registrasi.id = detail.registrasi_id')
                ->where('detail.cluster_id', $c['id'])
                ->where('registrasi.user_id', $userId)
                ->findAll();

            $result = [];
            foreach ($detail as $row) {
                $durasi = $this->durasiModel->getDurasi($c['id'], $row['registrasi_id']);

                $res = [];
                $det2 = $this->detailModel->findByClusterRegistrasi($c['id'], $row['registrasi_id']);
                foreach ($det2 as $row2) {
                    $res[] = [
                        'dive_spot' => $this->diveSpotModel->find($row2['dive_spot_id']),
                        'jam' => $this->detailJamModel->getJam($row2['id'])
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

            // urutkan berdasarkan durasi tgl_masuk
            usort($result, function ($a, $b) {
                return $a['durasi']['tgl_masuk'] <=> $b['durasi']['tgl_masuk'];
            });

            $hasil[] = [
                'cluster' => $c,
                'registrasi' => $result
            ];
        }

        $data['hasil'] = $hasil;

        return view('riwayat', $data);
    }
}
