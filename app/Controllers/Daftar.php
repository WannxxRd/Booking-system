<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Daftar extends BaseController
{
    public function index()
    {
        if ($this->request->is('post')) {
            // Atur rules awal
            $rules = [
                'jenis_user' => ['label' => 'Jenis User', 'rules' => 'required'],
                'nama' => ['label' => 'Nama', 'rules' => 'required|is_unique[user.nama]', 'errors' => ['is_unique' => '{field} sudah terdaftar']],
                'nama_operator' => ['label' => 'Nama Operator', 'rules' => 'required'],
                'nomor_wa' => ['label' => 'Nomor WA', 'rules' => 'required|is_unique[user.nomor_wa]', 'errors' => ['is_unique' => '{field} sudah terdaftar']],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[user.email]', 'errors' => ['is_unique' => '{field} sudah digunakan']],
                'password' => ['label' => 'Password', 'rules' => 'required'],
                'max_penumpang' => ['label' => 'Jumlah Maksimum', 'rules' => 'required|regex_match[/^(?:[1-9]|1[0-9]|20)$/]'],
            ];

            // Tambahkan rules sesuai jenis_user
            if ($this->request->getPost('jenis_user') === 'Kapal') {
                $rules['gt_kapal'] = ['label' => 'GT Kapal', 'rules' => 'required|decimal'];
                $rules['asal_kapal'] = ['label' => 'Asal Kapal', 'rules' => 'required'];
            } elseif ($this->request->getPost('jenis_user') === 'Land Base') {
                $rules['lokasi'] = ['label' => 'Lokasi', 'rules' => 'required'];
                $rules['foto'] = [
                    'label' => 'Foto',
                    'rules' => 'uploaded[foto]|max_size[foto,5000]|is_image[foto]',
                    'errors' => [
                        'uploaded' => '{field} wajib diunggah',
                        'max_size' => '{field} maksimal 1MB',
                        'is_image' => 'File yang diunggah harus gambar'
                    ]
                ];
            }

            // Jalankan validasi
            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Ambil data POST
            $params = [
                'jenis_user' => $this->request->getPost('jenis_user'),
                'nama' => $this->request->getPost('nama'),
                'nama_operator' => $this->request->getPost('nama_operator'),
                'nomor_wa' => $this->request->getPost('nomor_wa'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'max_penumpang' => $this->request->getPost('max_penumpang')
            ];

            // Jika Kapal
            if ($params['jenis_user'] === 'Kapal') {
                $params['gt_kapal'] = $this->request->getPost('gt_kapal');
                $params['asal_kapal'] = $this->request->getPost('asal_kapal');
            }

            // Jika Land Base
            if ($params['jenis_user'] === 'Land Base') {
                $params['lokasi'] = $this->request->getPost('lokasi');

                // Upload foto
                $foto = $this->request->getFile('foto');
                if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                    $newName = $foto->getRandomName();
                    $foto->move(FCPATH . 'uploads/foto', $newName);
                    $params['foto'] = $newName;
                }
            }

            // Simpan ke DB
            $result = model(UserModel::class)->insert($params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Registrasi berhasil<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Registrasi gagal<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return redirect()->to('daftar');
        }

        return view('daftar');
    }
}
