<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data['user'] = model('UserModel')->countAll();
        $data['jam'] = model('JamModel')->countAll();
        $data['dive_spot'] = model('DiveSpotModel')->countAll();

        return view('admin/home', $data);
    }
}
