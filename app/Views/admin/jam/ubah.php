<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4"><span class="text-muted fw-light">Data Jam /</span> Ubah</h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ubah Data Jam</h5>
                </div>
                <div class="card-body">

                    <form action="<?= base_url('admin/jam/ubah/' . $jam['id']) ?>" method="post">

                        <?= csrf_field() ?>
                        <?= validation_list_errors('my_list') ?>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama_jam">Jam <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_jam" name="nama_jam" value="<?= old('nama_jam', $jam['nama_jam']) ?>" required />
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success"><i class="bx bx-save me-1"></i> Simpan</button>
                                <a href="<?= base_url('admin/jam') ?>" class="btn btn-secondary"><i class="bx bx-x me-1"></i> Batal</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>