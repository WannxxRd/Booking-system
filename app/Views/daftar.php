<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<section id="starter-section" class="starter-section section">

    <div class="container">
        <div class="card mt-2 text-dark bg-light mb-2">
            <div class="card-header">
                <h3 class="text-center">REGISTRASI USER</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center my-4">
                    <div class="col-md-8">

                        <?= session()->getFlashdata('pesan'); ?>

                        <?php $errors = session('errors'); ?>

                        <form action="<?= base_url('daftar') ?>" method="post" id="form-login" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">Jenis User</label>
                                <select name="jenis_user" id="jenis_user" class="form-select <?= isset($errors['jenis_user']) ? 'is-invalid' : '' ?>">
                                    <option value="">- Pilih -</option>
                                    <option value="Kapal" <?= old('jenis_user') == 'Kapal' ? 'selected' : '' ?>>Kapal</option>
                                    <option value="Land Base" <?= old('jenis_user') == 'Land Base' ? 'selected' : '' ?>>Land Base</option>
                                </select>
                                <div class="invalid-feedback"><?= $errors['jenis_user'] ?? '' ?></div>
                            </div>
                            <div class="mb-3">
                                <label id="label_nama">Nama Kapal / Homestay / Resort</label>
                                <input type="text" name="nama" value="<?= old('nama') ?>" class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback"><?= $errors['nama'] ?? '' ?></div>
                            </div>
                            <div class="mb-3">
                                <label>Nama Operator</label>
                                <input type="text" name="nama_operator" value="<?= old('nama_operator') ?>" class="form-control <?= isset($errors['nama_operator']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback"><?= $errors['nama_operator'] ?? '' ?></div>
                            </div>
                            <div class="mb-3">
                                <label>Nomor WA</label>
                                <input type="number" name="nomor_wa" value="<?= old('nomor_wa') ?>" class="form-control <?= isset($errors['nomor_wa']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback"><?= $errors['nomor_wa'] ?? '' ?></div>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="email" value="<?= old('email') ?>" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="text" name="password" value="<?= old('password') ?>" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback"><?= $errors['password'] ?? '' ?></div>
                            </div>

                            <div id="resort-homestay">
                                <div class="mb-3">
                                    <label>Lokasi Homestay / Resort</label>
                                    <input type="text" name="lokasi" value="<?= old('lokasi') ?>" class="form-control <?= isset($errors['lokasi']) ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback"><?= $errors['lokasi'] ?? '' ?></div>
                                </div>
                                <div class="mb-3">
                                    <label>Foto Homestay / Resort</label>
                                    <input type="file" name="foto" class="form-control <?= isset($errors['foto']) ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback"><?= $errors['foto'] ?? '' ?></div>
                                </div>
                            </div>
                            <div id="kapal">
                                <div class="mb-3">
                                    <label>GT Kapal</label>
                                    <input type="number" step="0.01" name="gt_kapal" value="<?= old('gt_kapal') ?>" class="form-control <?= isset($errors['gt_kapal']) ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback"><?= $errors['gt_kapal'] ?? '' ?></div>
                                </div>
                                <div class="mb-3">
                                    <label>Asal Kapal</label>
                                    <input type="text" name="asal_kapal" value="<?= old('asal_kapal') ?>" class="form-control <?= isset($errors['asal_kapal']) ? 'is-invalid' : '' ?>">
                                    <div class="invalid-feedback"><?= $errors['asal_kapal'] ?? '' ?></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label id="label_max_penumpang">Jumlah Maksimum Penumpang / Tamu</label>
                                <input type="number" name="max_penumpang" value="<?= old('max_penumpang') ?>" class="form-control <?= isset($errors['max_penumpang']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback"><?= $errors['max_penumpang'] ?? '' ?></div>
                            </div>
                            <div class="d-grid text-center">
                                <button type="submit" class="btn btn-primary" id="continue-btn">Registrasi</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        $('#jenis_user').change(function() {
            var jenis_user = $(this).val();
            if (jenis_user === 'Kapal') {
                $('#resort-homestay').hide();
                $('#kapal').show();
                $('#label_nama').html('Nama Kapal');
                $('#label_max_penumpang').html('Jumlah Maksimum Penumpang');
            } else if (jenis_user === 'Land Base') {
                $('#resort-homestay').show();
                $('#kapal').hide();
                $('#label_nama').html('Nama Homestay / Resort');
                $('#label_max_penumpang').html('Jumlah Maksimum Tamu');
            } else {
                $('#kapal, #resort-homestay').hide();
                $('#label_nama').html('Nama Kapal / Homestay / Resort');
                $('#label_max_penumpang').html('Jumlah Maksimum Penumpang / Tamu');
            }
        }).trigger('change');
    });
</script>
<?= $this->endSection() ?>