<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Kontak Kami</h3>
                </div>
                <div class="card-body">
                    <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi kami melalui informasi berikut:</p>
                    <ul>
                        <li>Email:
                            <a href="mailto:ridwan.umsorong.com">ridwan.umsorong@gmail.com</a>
                        </li>
                        <li>Telepon: +62 82238740208</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <iframe src="https://maps.app.goo.gl/NpyRpYDxLXQCdsMZ6" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
<?= $this->endSection() ?>