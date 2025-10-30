<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

$routes->get('daftar', 'Daftar::index');
$routes->post('daftar', 'Daftar::index');


$routes->get('kontak', 'Kontak::index');

$routes->get('login', 'Login::index');
$routes->post('login/cek', 'Login::cek');
$routes->get('logout', 'Login::logout');

$routes->group('admin', function ($routes) {
    $routes->get('login', 'Admin\Login::index');
    $routes->post('login/cek', 'Admin\Login::cek');
    $routes->get('logout', 'Admin\Login::logout');
});

$routes->group('', ['filter' => 'auth_user'], function ($routes) {
    $routes->get('profil', 'Profil::index');
    $routes->post('profil', 'Profil::index');

    $routes->get('registrasi', 'Registrasi::index');
    $routes->get('registrasi/reset', 'Registrasi::reset');
    $routes->post('registrasi/proses', 'Registrasi::proses');
    $routes->post('registrasi/proses2', 'Registrasi::proses2');
    $routes->get('registrasi/hapus/(:any)', 'Registrasi::hapus/$1');
    $routes->get('registrasi/simpan', 'Registrasi::simpan');
    $routes->post('registrasi/getDiveSpot', 'Registrasi::getDiveSpot');
    $routes->post('registrasi/getDurasiCluster', 'Registrasi::getDurasiCluster');
    $routes->post('registrasi/getJam', 'Registrasi::getJam');
    $routes->post('registrasi/getTotalKapal', 'Registrasi::getTotalKapal');

    $routes->get('riwayat', 'Riwayat::index');
});

$routes->group('admin', ['filter' => ['auth_admin', 'role_filter:1,2']], function ($routes) {
    $routes->get('', 'Admin\Home::index');
    $routes->get('home', 'Admin\Home::index');
    $routes->add('password', 'Admin\Admin::password');

    $routes->get('jam', 'Admin\Jam::index');
    $routes->add('jam/tambah', 'Admin\Jam::tambah');
    $routes->add('jam/ubah/(:num)', 'Admin\Jam::ubah/$1');
    $routes->post('jam/hapus/(:num)', 'Admin\Jam::hapus/$1');

    $routes->get('dive_spot', 'Admin\DiveSpot::index_cluster');
    $routes->get('dive_spot/(:num)', 'Admin\DiveSpot::index/$1');
    $routes->add('dive_spot/tambah/(:num)', 'Admin\DiveSpot::tambah/$1');
    $routes->add('dive_spot/ubah/(:num)/(:num)', 'Admin\DiveSpot::ubah/$1/$2');
    $routes->post('dive_spot/hapus/(:num)/(:num)', 'Admin\DiveSpot::hapus/$1/$2');

    $routes->get('user', 'Admin\User::index');
    $routes->post('user/hapus/(:num)', 'Admin\User::hapus/$1');

    $routes->get('riwayat', 'Admin\Riwayat::index');
    $routes->post('riwayat/hapus/(:num)', 'Admin\Riwayat::hapus/$1');

    $routes->get('laporan/pdf', 'Admin\Laporan::pdf');
    $routes->get('laporan/excel', 'Admin\Laporan::excel');
    $routes->get('laporan', 'Admin\Laporan::index');
});

$routes->group('admin', ['filter' => ['auth_admin', 'role_filter:1']], function ($routes) {
    $routes->get('admin', 'Admin\Admin::index');
    $routes->add('admin/tambah', 'Admin\Admin::tambah');
    $routes->add('admin/ubah/(:num)', 'Admin\Admin::ubah/$1');
    $routes->post('admin/hapus/(:num)', 'Admin\Admin::hapus/$1');
    $routes->post('admin/reset', 'Admin\Admin::reset');
});
