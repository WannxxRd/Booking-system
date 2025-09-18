<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $allowedFields    = ['nama', 'jenis_user', 'nama_operator', 'nomor_wa', 'email', 'password', 'lokasi', 'foto', 'gt_kapal', 'asal_kapal', 'max_penumpang'];

    protected $useTimestamps = false;
}
