<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailJamModel extends Model
{
    protected $table            = 'detail_jam';
    protected $allowedFields    = ['detail_id', 'jam_id'];

    protected $useTimestamps = false;

    public function getJam($detail_id)
    {
        return $this->select('jam.id, jam.nama_jam')
            ->join('jam', 'jam.id = detail_jam.jam_id', 'left')
            ->where('detail_jam.detail_id', $detail_id)
            ->findAll();
    }
}
