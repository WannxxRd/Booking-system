<?php if (session()->get('logged_in')): ?>
    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="<?= base_url() ?>#hero">Home</a></li>
            <li><a href="<?= base_url('riwayat') ?>">Riwayat</a></li>
            <li><a href="<?= base_url('profil') ?>">Profil</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <a class="btn-getstarted flex-md-shrink-0" href="<?= base_url('registrasi') ?>">Registrasi</a>
<?php else: ?>
    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="<?= base_url() ?>#hero">Home</a></li>
            <li><a href="<?= base_url('daftar') ?>">Registrasi User</a></li>
            <li><a href="<?= base_url('kontak') ?>">Kontak Kami</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <a class="btn-getstarted flex-md-shrink-0" href="<?= base_url('login') ?>">Login</a>
<?php endif; ?>