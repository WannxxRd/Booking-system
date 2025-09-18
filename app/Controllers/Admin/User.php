<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $data['user'] = $this->user->findAll();

        return view('admin/user/index', $data);
    }

    public function hapus($id)
    {
        $result = $this->user->delete($id);

        if ($result) {
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil dihapus<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal dihapus<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        return redirect()->to('admin/user');
    }
}
