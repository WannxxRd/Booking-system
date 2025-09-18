<?php

namespace App\Models;

use CodeIgniter\Model;

class ClusterModel extends Model
{
    protected $table            = 'cluster';
    protected $allowedFields    = ['nama_cluster'];

    protected $useTimestamps = false;
}
