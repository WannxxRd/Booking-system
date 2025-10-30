<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kontak extends BaseController
{
    public function index()
    {
        return view('kontak');
    }
}
