<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrasiModel extends Model
{
    protected $table            = 'registrasi';
    protected $allowedFields    = ['user_id', 'jml_penumpang', 'dokumen', 'tgl_registrasi'];

    protected $useTimestamps = false;
}
