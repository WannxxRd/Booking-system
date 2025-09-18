<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Login extends BaseController
{
    public function index()
    {
        if (session()->has('logged_in')) {
            return redirect()->to('admin/home');
        }

        return view('admin/login');
    }

    public function cek()
    {
        if ($this->request->is('post')) {
            $user = new AdminModel();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $result = $user->select('admin.*, role.nama_role')
                ->join('role', 'role.id = admin.role_id', 'left')
                ->where('username', $username)
                ->where('aktif', 1)
                ->first();

            if (empty($result)) {
                session()->setFlashdata('pesan', '<div class="alert alert-danger text-center" role="alert">User tidak terdaftar atau nonaktif</div>');
                return redirect()->back()->withInput();
            }

            if (password_verify($password, $result['password'])) {
                $session_data = array(
                    'id' => $result['id'],
                    'nama_lengkap' => $result['nama_lengkap'],
                    'username' => $result['username'],
                    'role_id' => $result['role_id'],
                    'nama_role' => $result['nama_role'],
                    'logged_in' => TRUE
                );

                session()->set($session_data);

                return redirect()->to('admin/home');
            }

            session()->setFlashdata('pesan', '<div class="alert alert-danger text-center" role="alert">Username atau Password salah</div>');
            return redirect()->back()->withInput();
        }

        return redirect()->to('admin/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login');
    }
}
