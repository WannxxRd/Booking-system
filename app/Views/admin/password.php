<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-4">Ubah Password</h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ubah Password</h5>
                </div>
                <div class="card-body">

                    <?= session()->getFlashdata('pesan'); ?>

                    <form action="<?= base_url('admin/password') ?>" method="post">

                        <?= csrf_field() ?>
                        <?= validation_list_errors('my_list') ?>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="password_lama">Password Lama</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password_lama" name="password_lama" value="<?= old('password_lama') ?>" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="password_baru">Password Baru</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password_baru" name="password_baru" value="" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="password_konfirmasi">Konfirmasi Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password_konfirmasi" name="password_konfirmasi" value="" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success"><i class="bx bx-save me-1"></i> Ubah</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>