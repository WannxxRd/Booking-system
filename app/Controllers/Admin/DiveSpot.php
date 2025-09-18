<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DiveSpotModel;

class DiveSpot extends BaseController
{
    protected $dive_spot;
    protected $validation;

    public function __construct()
    {
        $this->dive_spot = new DiveSpotModel();
        $this->validation = service('validation');
    }

    public function index_cluster()
    {
        $data['cluster'] = model('ClusterModel')->findAll();

        return view('admin/dive_spot/index_cluster', $data);
    }

    public function index($cluster_id)
    {
        $data['dive_spot'] = $this->dive_spot->where('cluster_id', $cluster_id)->findAll();
        $data['cluster'] = model('ClusterModel')->find($cluster_id);

        return view('admin/dive_spot/index', $data);
    }

    public function tambah($cluster_id)
    {
        if ($this->request->is('post')) {
            $this->validation->setRules([
                'nama_dive_spot' => ['label' => 'Nama Dive Spot', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
                'aktif' => ['label' => 'Status', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run() == false) {
                return redirect()->back()->withInput();
            }

            $params = [
                'cluster_id' => $cluster_id,
                'nama_dive_spot' => $this->request->getPost('nama_dive_spot'),
                'aktif' => $this->request->getPost('aktif'),
            ];

            $result = $this->dive_spot->insert($params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil disimpan<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal disimpan<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return redirect()->to('admin/dive_spot/' . $cluster_id);
        }

        $data['cluster_id'] = $cluster_id;

        return view('admin/dive_spot/tambah', $data);
    }

    public function ubah($id, $cluster_id)
    {
        $data['dive_spot'] = $this->dive_spot->find($id);
        $data['cluster_id'] = $cluster_id;

        if ($this->request->is('post')) {
            $this->validation->setRules([
                'nama_dive_spot' => ['label' => 'Nama Dive Spot', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
                'aktif' => ['label' => 'Status', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
            ]);

            if ($this->validation->withRequest($this->request)->run() == false) {
                return redirect()->back()->withInput();
            }

            $params = [
                'nama_dive_spot' => $this->request->getPost('nama_dive_spot'),
                'aktif' => $this->request->getPost('aktif'),
            ];

            $result = $this->dive_spot->update($id, $params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return redirect()->to('admin/dive_spot/' . $cluster_id);
        }

        return view('admin/dive_spot/ubah', $data);
    }

    public function hapus($id, $cluster_id)
    {
        $result = $this->dive_spot->delete($id);

        if ($result) {
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil dihapus<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal dihapus<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        return redirect()->to('admin/dive_spot/' . $cluster_id);
    }
}
