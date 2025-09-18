<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $allowedFields    = ['nama_lengkap', 'username', 'password', 'role_id', 'aktif'];

    protected $useTimestamps = false;
}
