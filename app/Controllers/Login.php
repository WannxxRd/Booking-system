<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        if (session()->has('logged_in')) {
            return redirect()->to('home');
        }

        return view('login');
    }

    public function cek()
    {
        if ($this->request->is('post')) {
            $user = new UserModel();

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $result = $user->where('email', $email)->first();

            if (empty($result)) {
                session()->setFlashdata('pesan', '<div class="alert alert-danger text-center" role="alert">User tidak terdaftar</div>');
                return redirect()->back()->withInput();
            }

            if (password_verify($password, $result['password'])) {
                $session_data = array(
                    'id' => $result['id'],
                    'nama' => $result['nama'],
                    'jenis_user' => $result['jenis_user'],
                    'logged_in' => TRUE
                );

                session()->set($session_data);

                return redirect()->to('home');
            }

            session()->setFlashdata('pesan', '<div class="alert alert-danger text-center" role="alert">Email atau Password salah</div>');
            return redirect()->back()->withInput();
        }

        return redirect()->to('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
