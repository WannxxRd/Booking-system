<?php

namespace App\Models;

use CodeIgniter\Model;

class JamModel extends Model
{
    protected $table            = 'jam';
    protected $allowedFields    = ['nama_jam'];

    protected $useTimestamps = false;
}
