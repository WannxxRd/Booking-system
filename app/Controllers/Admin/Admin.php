<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $admin;
    protected $validation;

    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->validation = service('validation');
    }

    public function index()
    {
        $data['admin'] = $this->admin->select('admin.*, role.nama_role')
            ->join('role', 'role.id = admin.role_id', 'left')
            ->findAll();

        return view('admin/admin/index', $data);
    }

    public function tambah()
    {
        if ($this->request->is('post')) {
            $this->validation->setRules([
                'nama_lengkap' => ['label' => 'Nama Lengkap', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
                'username' => ['label' => 'Username', 'rules' => 'required|is_unique[admin.username]', 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah terdaftar']],
                'password' => ['label' => 'Password', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
                'role_id' => ['label' => 'Role', 'rules' => 'required', 'errors' => ['required' => '{field} harus dipilih']],
                'aktif' => ['label' => 'Status', 'rules' => 'required', 'errors' => ['required' => '{field} harus dipilih']],
            ]);

            if ($this->validation->withRequest($this->request)->run() == false) {
                return redirect()->back()->withInput();
            }

            $params = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role_id' => $this->request->getPost('role_id'),
                'aktif' => $this->request->getPost('aktif')
            ];

            $result = $this->admin->insert($params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil disimpan<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal disimpan<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return redirect()->to('admin/admin');
        }

        $data['role'] = model('RoleModel')->findAll();
        return view('admin/admin/tambah', $data);
    }

    public function ubah($id)
    {
        $data['admin'] = $this->admin->find($id);
        $data['role'] = model('RoleModel')->findAll();

        if ($this->request->is('post')) {
            $this->validation->setRules([
                'nama_lengkap' => ['label' => 'Nama Lengkap', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
                'username' => ['label' => 'Username', 'rules' => 'required|is_unique[admin.username,id,' . $id . ']', 'errors' => ['required' => '{field} harus diisi', 'is_unique' => '{field} sudah terdaftar']],
                'role_id' => ['label' => 'Role', 'rules' => 'required', 'errors' => ['required' => '{field} harus dipilih']],
                'aktif' => ['label' => 'Status', 'rules' => 'required', 'errors' => ['required' => '{field} harus dipilih']],
            ]);

            if ($this->validation->withRequest($this->request)->run() == false) {
                return redirect()->back()->withInput();
            }

            $params = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'username' => $this->request->getPost('username'),
                'role_id' => $this->request->getPost('role_id'),
                'aktif' => $this->request->getPost('aktif')
            ];

            $result = $this->admin->update($id, $params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return redirect()->to('admin/admin');
        }

        return view('admin/admin/ubah', $data);
    }

    public function hapus($id)
    {
        $result = $this->admin->delete($id);

        if ($result) {
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Data berhasil dihapus<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Data gagal dihapus<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        return redirect()->to('admin/admin');
    }

    public function password()
    {
        if ($this->request->is('post')) {
            $this->validation->setRules([
                'password_lama' => ['label' => 'Password Lama', 'rules' => 'required|passlama', 'errors' => ['required' => '{field} harus diisi', 'passlama' => '{field} salah']],
                'password_baru' => ['label' => 'Password Baru', 'rules' => 'required', 'errors' => ['required' => '{field} harus diisi']],
                'password_konfirmasi' => ['label' => 'Konfirmasi Password', 'rules' => 'required|matches[password_baru]', 'errors' => ['required' => '{field} harus diisi', 'matches' => '{field} tidak sama dengan Password Baru']],
            ]);

            if ($this->validation->withRequest($this->request)->run() == false) {
                return redirect()->back()->withInput();
            }

            $params = [
                'password' => password_hash($this->request->getPost('password_baru'), PASSWORD_DEFAULT)
            ];

            $result = $this->admin->update(session()->get('id'), $params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Password berhasil diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Password gagal diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return redirect()->to('admin/password');
        }

        return view('admin/password');
    }

    public function reset()
    {
        if ($this->request->is('post')) {
            $id = $this->request->getPost('id');
            $password = $this->request->getPost('password');

            $params = [
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            $result = $this->admin->update($id, $params);

            if ($result) {
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">Password berhasil direset<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">Password gagal direset<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }

            return $this->response->setJSON(['status' => 'success']);
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
    }
}
