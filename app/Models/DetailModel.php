<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{
    protected $table            = 'detail';
    protected $allowedFields    = ['registrasi_id', 'cluster_id', 'tanggal', 'dive_spot_id'];

    protected $useTimestamps = false;

    public function getDetail($clusterId, $tanggal, $diveSpotId)
    {
        return $this->where('cluster_id', $clusterId)
            ->where('tanggal', $tanggal)
            ->where('dive_spot_id', $diveSpotId)
            ->findAll();
    }

    public function findByIdCluster($clusterId)
    {
        return $this->select('registrasi_id')
            ->where('cluster_id', $clusterId)
            ->groupBy('registrasi_id')
            ->findAll();
    }

    public function findByClusterRegistrasi($clusterId, $registrasiId)
    {
        return $this->where('cluster_id', $clusterId)
            ->where('registrasi_id', $registrasiId)
            ->findAll();
    }

    public function findByRegistrasi($registrasiId)
    {
        return $this->select('detail.*, cluster.nama_cluster, dive_spot.nama_dive_spot')
            ->join('cluster', 'cluster.id = detail.cluster_id', 'left')
            ->join('dive_spot', 'dive_spot.id = detail.dive_spot_id', 'left')
            ->where('registrasi_id', $registrasiId)
            ->findAll();
    }

    public function deleteByCluster($registrasiId, $clusterId)
    {
        return $this->where('registrasi_id', $registrasiId)
            ->where('cluster_id', $clusterId)
            ->delete();
    }

    public function countExistingShips($clusterId, $tanggal, $diveSpotId, $jamId)
    {
        return $this->join('detail_jam', 'detail_jam.detail_id = detail.id')
            ->where('cluster_id', $clusterId)
            ->where('tanggal', $tanggal)
            ->where('dive_spot_id', $diveSpotId)
            ->where('detail_jam.jam_id', $jamId)
            ->countAllResults();
    }
}
