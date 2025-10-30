<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Daftar extends BaseController
{
    public function index()
    {
        return view('kontak');
    }
}
