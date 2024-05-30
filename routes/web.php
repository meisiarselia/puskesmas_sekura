<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/beranda'));
Route::get('/beranda', HomeController::class)->name('home');

Route::controller(PendaftaranController::class)->group(function () {
    Route::get('/pendaftaranonline', 'index')->name('pendaftaranonline');
    Route::get('/pendaftaranonline/registrasi', 'registrasi')->name('pendaftaranonline.registrasi');
    Route::post('/pendaftaranonline/registrasi', 'registrasiProses')->name('pendaftaranonline.registrasi.proses');
    Route::get('/pendaftaranonline/daftar', 'daftar')->name('pendaftaranonline.daftar');
    Route::post('/pendaftaranonline/daftar', 'daftarProses')->name('pendaftaranonline.daftar.proses');
    Route::get('/pendaftaranonline/alur-pendaftaran', 'alurPendaftaran')->name('pendaftaranonline.alur-pendaftaran');
    Route::get('/pendaftaranonline/berhasil/{from}/{id}', 'berhasil')->name('pendaftaranonline.berhasil');
});

Route::controller(TentangController::class)->group(function () {
    Route::get('/tentang', 'index')->name('tentang.index');
    Route::get('/tentang/struktur-organisasi', 'strukturOrganisasi')->name('tentang.struktur-organisasi');
    Route::get('/tentang/kegiatan', 'kegiatan')->name('tentang.kegiatan');
    Route::get('/tentang/prestasi', 'prestasi')->name('tentang.prestasi');
});

Route::controller(PelayananController::class)->group(function () {
    Route::get('/pelayanan/jenis-pelayanan', 'jenisPelayanan')->name('pelayanan.jenis-pelayanan');
    Route::get('/pelayanan/jenis-pelayanan/{layananMedis}', 'jenisPelayananShow')->name('pelayanan.jenis-pelayanan.show');
    Route::get('/pelayanan/fasilitas', 'fasilitas')->name('pelayanan.fasilitas');
    Route::get('/pelayanan/fasilitas/{fasilitas}', 'fasilitasShow')->name('pelayanan.fasilitas.show');
    Route::get('/pelayanan/kritik-saran', 'kritikSaran')->name('pelayanan.kritik-saran');
    Route::post('/pelayanan/kritik-saran/create', 'kritikSaranCreate')->name('pelayanan.kritik-saran.create');
});

Route::controller(ProfilController::class)->group(function () {
    Route::get('/profil/visi-misi', 'visiMisi')->name('profil.visi-misi');
    Route::get('/profil/akreditasi', 'akreditasi')->name('profil.akreditasi');
});

Route::controller(Admin\LoginController::class)->group(function () {
    Route::get('admin/login', 'index')->middleware('guest')->name('login');
    Route::post('admin/login', 'login')->middleware('guest')->name('login.perform');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', fn() => redirect('/admin/dashboard'));
    Route::get('/admin/dashboard', [Admin\DashboardController::class, 'index'])->name('home');
    Route::controller(Admin\PasienController::class)->group(function () {
        Route::get('/admin/data-pasien', 'index')->name('pasien.index');
        Route::post('/admin/data-pasien/validate/{pasien}', 'validatePasien')->name('pasien.validate');
        Route::get('/admin/data-pasien/create/{pasien?}', 'create')->name('pasien.create');
        Route::post('/admin/data-pasien', 'store')->name('pasien.store');
        Route::put('/admin/data-pasien/{pasien}', 'update')->name('pasien.update');
        Route::delete('/admin/data-pasien/{pasien}', 'delete')->name('pasien.delete');
    });
    Route::controller(Admin\PendaftaranController::class)->group(function () {
        Route::get('/admin/pendaftaran', 'index')->name('pendaftaran.index');
        Route::post('/admin/pendaftaran/checkin/{pendaftaran}', 'checkin')->name('pendaftaran.checkin');
        Route::get('/admin/pendaftaran/create/{pendaftaran?}', 'create')->name('pendaftaran.create');
        Route::post('/admin/pendaftaran', 'store')->name('pendaftaran.store');
        Route::put('/admin/pendaftaran/{pendaftaran}', 'update')->name('pendaftaran.update');
        Route::delete('/admin/pendaftaran/{pendaftaran}', 'delete')->name('pendaftaran.delete');
    });
    Route::controller(Admin\Tentang\StrukturOrganisasiController::class)->group(function () {
        Route::get('/admin/tentang/struktur-organisasi', 'index')->name('struktur-organisasi.index');
        Route::post('/admin/tentang/struktur-organisasi', 'update')->name('struktur-organisasi.update');
    });
    Route::controller(Admin\Tentang\PrestasiController::class)->group(function () {
        Route::get('/admin/tentang/prestasi', 'index')->name('prestasi.index');
        Route::get('/admin/tentang/prestasi/create/{prestasi?}', 'create')->name('prestasi.create');
        Route::post('/admin/tentang/prestasi', 'store')->name('prestasi.store');
        Route::put('/admin/tentang/prestasi/{prestasi}', 'update')->name('prestasi.update');
        Route::delete('/admin/tentang/prestasi/{prestasi}', 'delete')->name('prestasi.delete');
    });
    Route::controller(Admin\Tentang\KegiatanController::class)->group(function () {
        Route::get('/admin/tentang/kegiatan', 'index')->name('kegiatan.index');
        Route::get('/admin/tentang/kegiatan/create/{kegiatan?}', 'create')->name('kegiatan.create');
        Route::post('/admin/tentang/kegiatan', 'store')->name('kegiatan.store');
        Route::put('/admin/tentang/kegiatan/{kegiatan}', 'update')->name('kegiatan.update');
        Route::delete('/admin/tentang/kegiatan/{kegiatan}', 'delete')->name('kegiatan.delete');
    });
    Route::controller(Admin\Pelayanan\JenisPelayananController::class)->group(function () {
        Route::get('/admin/pelayanan/jenis-pelayanan', 'index')->name('jenis-pelayanan.index');
        Route::get('/admin/pelayanan/jenis-pelayanan/create/{jenis_pelayanan?}', 'create')->name('jenis-pelayanan.create');
        Route::post('/admin/pelayanan/jenis-pelayanan', 'store')->name('jenis-pelayanan.store');
        Route::put('/admin/pelayanan/jenis-pelayanan/{jenis_pelayanan}', 'update')->name('jenis-pelayanan.update');
        Route::delete('/admin/pelayanan/jenis-pelayanan/{jenis_pelayanan}', 'delete')->name('jenis-pelayanan.delete');
    });
    Route::get('/admin/pelayanan/kritik-saran', Admin\Pelayanan\KritikSaranController::class)->name('kritik-saran.index');
    Route::controller(Admin\Pelayanan\FasilitasController::class)->group(function () {
        Route::get('/admin/pelayanan/fasilitas', 'index')->name('fasilitas.index');
        Route::get('/admin/pelayanan/fasilitas/create/{fasilitas?}', 'create')->name('fasilitas.create');
        Route::post('/admin/pelayanan/fasilitas', 'store')->name('fasilitas.store');
        Route::put('/admin/pelayanan/fasilitas/{fasilitas}', 'update')->name('fasilitas.update');
        Route::delete('/admin/pelayanan/fasilitas/{fasilitas}', 'delete')->name('fasilitas.delete');
    });
    Route::controller(Admin\Profil\VisiMisiController::class)->group(function () {
        Route::get('/admin/profil/visi-misi', 'index')->name('visi-misi.index');
        Route::post('/admin/profil/visi-misi', 'update')->name('visi-misi.update');
    });
    Route::controller(Admin\Profil\DireksiController::class)->group(function () {
        Route::get('/admin/profil/direksi', 'index')->name('direksi.index');
        Route::get('/admin/profil/direksi/create/{direksi?}', 'create')->name('direksi.create');
        Route::post('/admin/profil/direksi', 'store')->name('direksi.store');
        Route::put('/admin/profil/direksi/{direksi}', 'update')->name('direksi.update');
        Route::delete('/admin/profil/direksi/{direksi}', 'delete')->name('direksi.delete');
    });
    Route::controller(Admin\Profil\AkreditasiController::class)->group(function () {
        Route::get('/admin/profil/akreditasi', 'index')->name('akreditasi.index');
        Route::post('/admin/profil/akreditasi', 'update')->name('akreditasi.update');
    });
    Route::controller(Admin\PoliController::class)->group(function () {
        Route::get('/admin/poli', 'index')->name('poli.index');
        Route::get('/admin/poli/create/{poli?}', 'create')->name('poli.create');
        Route::post('/admin/poli/store', 'store')->name('poli.store');
        Route::put('/admin/poli/update/{poli?}', 'update')->name('poli.update');
        Route::delete('/admin/poli/{poli}', 'delete')->name('poli.delete');
    });
    Route::controller(Admin\FaqController::class)->group(function () {
        Route::get('/admin/faq', 'index')->name('faq.index');
        Route::get('/admin/faq/create/{faq?}', 'create')->name('faq.create');
        Route::post('/admin/faq/store', 'store')->name('faq.store');
        Route::put('/admin/faq/update/{faq?}', 'update')->name('faq.update');
        Route::delete('/admin/faq/{faq}', 'delete')->name('faq.delete');
    });
    Route::controller(Admin\KontakController::class)->group(function () {
        Route::get('/admin/kontak', 'index')->name('kontak.index');
        Route::post('/admin/kontak', 'update')->name('kontak.update');
    });
    Route::post('admin/logout', [Admin\LoginController::class, 'logout'])->name('logout.perform');
    Route::get('storage/{dir}/{filename}', Admin\StorageController::class)->name('storage');
});



