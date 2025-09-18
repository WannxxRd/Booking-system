<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profil extends BaseController
{
    public function index()
    {
        if ($this->request->is('post')) {
            $userModel = model(UserModel::class);
            $user = $userModel->find(session('id'));

            $rules = [
                'nama' => ['label' => 'Nama', 'rules' => 'required'],
                'nama_operator' => ['label' => 'Nama Operator', 'rules' => 'required'],
                'nomor_wa' => ['label' => 'Nomor WA', 'rules' => 'required'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'max_penumpang' => ['label' => 'Jumlah Maksimum', 'rules' => 'required|integer']
            ];

            // Tambahkan rules sesuai jenis_user
            if ($user['jenis_user'] === 'Kapal') {
                $rules['gt_kapal'] = ['label' => 'GT Kapal', 'rules' => 'required|decimal'];
                $rules['asal_kapal'] = ['label' => 'Asal Kapal', 'rules' => 'required'];
            } elseif ($user['jenis_user'] === 'Land Base') {
                $rules['lokasi'] = ['label' => 'Lokasi', 'rules' => 'required'];
                $rules['foto'] = [
                    'label' => 'Foto',
                    'rules' => 'max_size[foto,5000]|is_image[foto]',
                    'errors' => [
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
                'nama' => $this->request->getPost('nama'),
                'nama_operator' => $this->request->getPost('nama_operator'),
                'nomor_wa' => $this->request->getPost('nomor_wa'),
                'email' => $this->request->getPost('email'),
                'max_penumpang' => $this->request->getPost('max_penumpang')
            ];

            if ($this->request->getPost('password')) {
                $params['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            // Jika Kapal
            if ($user['jenis_user'] === 'Kapal') {
                $params['gt_kapal'] = $this->request->getPost('gt_kapal');
                $params['asal_kapal'] = $this->request->getPost('asal_kapal');
            }

            // Jika Land Base
            if ($user['jenis_user'] === 'Land Base') {
                $params['lokasi'] = $this->request->getPost('lokasi');

                // Upload foto
                $foto = $this->request->getFile('foto');
                if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                    // Hapus foto lama jika ada
                    if (!empty($user['foto']) && file_exists(FCPATH . 'uploads/foto/' . $user['foto'])) {
                        unlink(FCPATH . 'uploads/foto/' . $user['foto']);
                    }

                    $newName = $foto->getRandomName();
                    $foto->move(FCPATH . 'uploads/foto', $newName);
                    $params['foto'] = $newName;
                }
            }

            $userModel->update(session('id'), $params);

            session()->setFlashdata('pesan', '<div class="alert alert-success">Profil berhasil disimpan</div>');
            return redirect()->to('profil');
        }

        $data['user'] = model(UserModel::class)->find(session('id'));

        return view('profil', $data);
    }
}
