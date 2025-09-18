<?php

namespace App\Models;

use CodeIgniter\Model;

class DiveSpotModel extends Model
{
    protected $table            = 'dive_spot';
    protected $allowedFields    = ['cluster_id', 'nama_dive_spot', 'aktif'];

    protected $useTimestamps = false;
}
