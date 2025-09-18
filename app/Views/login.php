<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<section id="starter-section" class="starter-section section">

    <div class="container">
        <div class="card mt-2 text-dark bg-light mb-2">
            <div class="card-header">
                <h3 class="text-center">Login User</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center my-4">
                    <div class="col-md-6">

                        <?= session()->getFlashdata('pesan'); ?>

                        <form action="<?= base_url('login/cek') ?>" method="post" id="form-login">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?= old('email') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="<?= old('password') ?>" required>
                            </div>
                            <div class="d-grid text-center">
                                <button type="submit" class="btn btn-primary" id="continue-btn">Login</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>