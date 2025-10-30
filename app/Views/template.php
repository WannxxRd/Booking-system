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
    <link href="<?= base_url('assets/landing/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/landing/vendor/datatables/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets/landing/css/main.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/landing/css/custom.css') ?>" rel="stylesheet">


</head>

<body class="starter-page-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="<?= base_url() ?>" class="logo d-flex align-items-center me-auto">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo">
                <h5 class="sitename">SISPANDALWAS</h5>
            </a>

            <?= view('menu') ?>

        </div>
    </header>

    <main class="main">

        <?= $this->renderSection('content'); ?>

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
    <script src="<?= base_url('assets/landing/vendor/jquery/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/landing/vendor/datatables/dataTables.bootstrap5.min.js') ?>"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('assets/landing/js/main.js') ?>"></script>
    <script>
        $(document).ready(function() {
            let dt = $("#datatable").DataTable({
                responsive: true,
                lengthChange: true,
                info: true,
                oLanguage: {
                    sSearch: "Cari : ",
                    sLengthMenu: "_MENU_ &nbsp;&nbsp;data per halaman",
                    sInfo: "Menampilkan _START_ s/d _END_ dari <b>_TOTAL_ data</b>",
                    sInfoEmpty: "",
                    sInfoFiltered: "(difilter dari _MAX_ total data)",
                    sZeroRecords: "Pencarian tidak ditemukan",
                    sEmptyTable: "Tidak ada data",
                },
                search: {
                    smart: false,
                },
            });

            dt.on("order.dt search.dt", function() {
                dt.column(0, {
                        search: "applied",
                        order: "applied",
                    })
                    .nodes()
                    .each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
            }).draw();
        });
    </script>
    <?= $this->renderSection('js') ?>

</body>

</html>