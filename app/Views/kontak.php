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

<!-- <div class="container">
    <div class="row">
        <div class="col-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.708793622138!2d119.6549266747572!3d-5.153797837603451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee32f6f6f4d7b%3A0x8e5f6c4b8e4e4e4e!2sUniversitas%20Muhammadiyah%20Sorong!5e0!3m2!1sid!2sid!4v1696351234567!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div> -->
<div class="map-section">
    <!-- Ganti src berikut dengan embed URL Google Maps Anda -->
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.133789034227!2d106.82512527480798!3d-6.214640293711218!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3bc8c8e5e8b%3A0x1e9e7a0a8c8e5e8b!2sJakarta!5e0!3m2!1sen!2sid!4v1703123456789!5m2!1sen!2sid"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>

    <!-- Fallback jika iframe tidak bisa dimuat -->
    <div class="map-placeholder">
        <div>
            <strong>Lokasi Kami</strong><br>
            Jl. Contoh Alamat No. 123<br>
            Jakarta, Indonesia
        </div>
    </div>
</div>
<?= $this->endSection() ?>