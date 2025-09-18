<?php

namespace App\Models;

use CodeIgniter\Model;

class DurasiModel extends Model
{
    protected $table            = 'durasi';
    protected $allowedFields    = ['registrasi_id', 'cluster_id', 'tanggal'];

    protected $useTimestamps = false;

    public function getDurasi($cluster_id, $registrasi_id)
    {
        return $this->select('MIN(tanggal) AS tgl_masuk, MAX(tanggal) AS tgl_keluar')
            ->where('cluster_id', $cluster_id)
            ->where('registrasi_id', $registrasi_id)
            ->first();
    }

    public function getTotalKapal($cluster_id)
    {
        return $this->select('tanggal, COUNT(DISTINCT registrasi_id) AS total')
            ->where('cluster_id', $cluster_id)
            ->groupBy('tanggal')
            ->findAll();
    }
}
