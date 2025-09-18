<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JamModel;

class Jam extends BaseController
{
    protected $jam;
    protected $validation;

    public function __construct()
    {
        $this->jam = new JamModel();
        $this->validation = service('validation');
    }

    public function index()
    {
        $data['jam'] = $this->jam->findAll();

        return view('admin/jam/index', $data);
    }

    public function tambah()
    {
        if ($this->request->is('post')) {
            $this->validation->setRules([
                'nama_jam' => ['label' => 'Jam', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run() == false) {
                return redirect()->back()->withInput();
            }

            $params = [
                'nama_jam' => $this->request->getPost('nama_jam'),
            ];

            $result = $this->jam->insert($params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil disimpan<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal disimpan<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return redirect()->to('admin/jam');
        }

        return view('admin/jam/tambah');
    }

    public function ubah($id)
    {
        $data['jam'] = $this->jam->find($id);

        if ($this->request->is('post')) {
            $this->validation->setRules([
                'nama_jam' => ['label' => 'Jam', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run() == false) {
                return redirect()->back()->withInput();
            }

            $params = [
                'nama_jam' => $this->request->getPost('nama_jam'),
            ];

            $result = $this->jam->update($id, $params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return redirect()->to('admin/jam');
        }

        return view('admin/jam/ubah', $data);
    }

    public function hapus($id)
    {
        $result = $this->jam->delete($id);

        if ($result) {
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil dihapus<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal dihapus<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        return redirect()->to('admin/jam');
    }
}
