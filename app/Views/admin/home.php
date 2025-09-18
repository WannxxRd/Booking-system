<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-0">Selamat Datang, <strong><?= session()->get('nama_lengkap') ?></strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-xl-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-header">User</div>
                <div class="card-body">
                    <i class="bx bx-user-circle card-icon"></i>
                    <h1 class="card-title text-white mb-0"><?= $user ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-info text-white mb-3">
                <div class="card-header">Dive Spot</div>
                <div class="card-body">
                    <i class="bx bx-map card-icon"></i>
                    <h1 class="card-title text-white mb-0"><?= $dive_spot ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-header">Jam</div>
                <div class="card-body">
                    <i class="bx bx-stopwatch card-icon"></i>
                    <h1 class="card-title text-white mb-0"><?= $jam ?></h1>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>