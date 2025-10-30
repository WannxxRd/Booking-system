<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SISPANDALWAS</title>
    <meta name="description" content="Aplikasi SISPANDALWAS">
    <meta name="keywords" content="sispandalwas">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/logo.png') ?>" rel="icon">
    <link href="<?= base_url('assets/img/logo.png') ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/landing/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/landing/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/landing/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/landing/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/landing/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets/landing/css/main.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/landing/css/custom.css') ?>" rel="stylesheet">

    <style>
        .hero-img {
            padding: 60px;
        }

        .password-wrapper {
            position: relative;
            width: 250px;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 35px;
        }

        .password-wrapper i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="<?= base_url() ?>" class="logo d-flex align-items-center me-auto">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo">
                <h1 class="sitename">SISPANDALWAS</h1>
            </a>

            <?= view('menu') ?>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">Sistem Pemantauan Pengendalian dan Pengawasan Kapal</h1>
                        <p data-aos="fade-up" data-aos-delay="100">
                        </p>
                        <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                            <?php if (session()->get('logged_in')): ?>
                                <a href="<?= base_url('registrasi') ?>" class="btn-get-started">Registrasi <i class="bi bi-arrow-right"></i></a>
                            <?php else: ?>
                                <a href="<?= base_url('login') ?>" class="btn-get-started">Login <i class="bi bi-arrow-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <img src="<?= base_url('assets/img/logo.png') ?>" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Values Section -->
        <section id="values" class="section">

            <!-- Section Title -->
            <div class="container section-title">
                <h2>Maps</h2>
                <p>Area Maps<br></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-12">
                        <div class="card">
                            <img src="<?= base_url('assets/img/Peta2.png') ?>" class="img-fluid" alt="">
                        </div>
                    </div><!-- End Card Item -->

                </div>

            </div>

        </section><!-- /Values Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">SISPANDALWAS</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                <!-- Template by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/aos/aos.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/glightbox/js/glightbox.min.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/imagesloaded/imagesloaded.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/swiper/swiper-bundle.min.js') ?>"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('assets/landing/js/main.js') ?>"></script>

</body>

</html>