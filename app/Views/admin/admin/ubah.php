<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4"><span class="text-muted fw-light">Data Admin /</span> Ubah</h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ubah Data Admin</h5>
                </div>
                <div class="card-body">

                    <form action="<?= base_url('admin/admin/ubah/' . $admin['id']) ?>" method="post">

                        <?= csrf_field() ?>
                        <?= validation_list_errors('my_list') ?>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap', $admin['nama_lengkap']) ?>" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="username">Username <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" value="<?= old('username', $admin['username']) ?>" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="role_id">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" id="role_id" name="role_id" required>
                                    <option value="">- Pilih Role -</option>
                                    <?php foreach ($role as $row): ?>
                                        <option value="<?= $row['id'] ?>" <?= old('role_id', $admin['role_id']) == $row['id'] ? 'selected' : '' ?>><?= $row['nama_role'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status1">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="aktif" id="status1" value="1" <?= old('aktif', $admin['aktif']) == '1' ? 'checked' : '' ?> />
                                    <label class="form-check-label" for="status1">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="aktif" id="status2" value="0" <?= old('aktif', $admin['aktif']) == '0' ? 'checked' : '' ?> />
                                    <label class="form-check-label" for="status2">Nonaktif</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success"><i class="bx bx-save me-1"></i> Simpan</button>
                                <a href="<?= base_url('admin/admin') ?>" class="btn btn-secondary"><i class="bx bx-x me-1"></i> Batal</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>