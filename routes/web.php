<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\PreventAbuse;
use Illuminate\Support\Facades\Route;

Route::resourceParameters(['pengurus' => 'pengurus', 'galeri' => 'album']);

Route::get('/', [PublicController::class, 'index'])->name('home');

Route::get('/search', [PublicController::class, 'search'])->name('search');
Route::get('/sitemap.xml', [PublicController::class, 'sitemap'])->name('sitemap');

Route::middleware(PreventAbuse::class)->group(function () {
    Route::get('/pengumuman', [PublicController::class, 'pengumuman'])->name('pengumuman');
    Route::get('/pengumuman/{pengumuman}', [PublicController::class, 'pengumumanShow'])->name('pengumuman.show');

    Route::get('/kegiatan', [PublicController::class, 'kegiatan'])->name('kegiatan');
    Route::get('/kegiatan/{kegiatan}', [PublicController::class, 'kegiatanShow'])->name('kegiatan.show');

    Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{album}', [PublicController::class, 'galeriShow'])->name('galeri.show');
});

Route::get('/pengurus-rt', [PublicController::class, 'pengurusRt'])->name('pengurus-rt');

Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/struktur-rw', [PublicController::class, 'strukturRw'])->name('struktur-rw');
Route::get('/statistik', [PublicController::class, 'statistik'])->name('statistik');
Route::get('/umkm', [PublicController::class, 'umkm'])->name('umkm');
Route::get('/umkm/{umkm:slug}', [PublicController::class, 'umkmShow'])->name('umkm.show');

Route::get('/layanan/administrasi-kependudukan', [PublicController::class, 'administrasiKependudukan'])->name('layanan.administrasi-kependudukan');
Route::get('/layanan/keamanan-wilayah', [PublicController::class, 'keamananWilayah'])->name('layanan.keamanan-wilayah');
Route::get('/layanan/kebersihan-lingkungan', [PublicController::class, 'kebersihanLingkungan'])->name('layanan.kebersihan-lingkungan');

Route::prefix('admin')->middleware(['auth', 'verified', 'check.admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/statistik-rw', [DashboardController::class, 'updateStatistikRw'])->name('admin.statistik-rw.update');

    Route::middleware('check.role:admin,sekretaris')->group(function () {
        Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
        Route::resource('/pengurus', PengurusController::class, ['as' => 'admin']);
        Route::resource('/pengumuman', AdminPengumumanController::class, ['except' => ['index'], 'as' => 'admin']);
        Route::resource('/kegiatan', AdminKegiatanController::class, ['except' => ['index'], 'as' => 'admin']);
        Route::resource('/galeri', GaleriController::class, ['as' => 'admin']);
        Route::delete('/galeri/{album}/foto/{foto}', [GaleriController::class, 'destroyFoto'])->name('admin.galeri.foto.destroy');
        Route::resource('/users', UserController::class, ['as' => 'admin']);
        Route::resource('/umkm', UmkmController::class, ['as' => 'admin']);

        Route::get('/statistik', [StatistikController::class, 'index'])->name('admin.statistik.index');
        Route::post('/statistik', [StatistikController::class, 'store'])->name('admin.statistik.store');
        Route::put('/statistik/{statistik}', [StatistikController::class, 'update'])->name('admin.statistik.update');
        Route::delete('/statistik/{statistik}', [StatistikController::class, 'destroy'])->name('admin.statistik.destroy');
    });

    Route::get('/log-aktivitas', [ActivityLogController::class, 'index'])->name('admin.activity-log.index');
    Route::get('/log-aktivitas/{id}', [ActivityLogController::class, 'show'])->name('admin.activity-log.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
