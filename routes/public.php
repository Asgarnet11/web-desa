<?php

use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\DataController;
use App\Http\Controllers\Public\LandingController;
use App\Http\Controllers\Public\LayananController;
use App\Http\Controllers\Public\PengaduanController;
use App\Http\Controllers\Public\PetaController;
use App\Http\Controllers\Public\UmkmController;
use App\Http\Controllers\Public\VerifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');

Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});

Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::post('/umkm', [UmkmController::class, 'store'])->name('umkm.store');

Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/', [PengaduanController::class, 'index'])->name('index');
    Route::post('/', [PengaduanController::class, 'store'])->name('store');
    Route::get('/cek', [PengaduanController::class, 'cek'])->name('cek');
});

// Inovasi: Satu Data & Open Data Hub
Route::get('/satu-data', [DataController::class, 'index'])->name('satu-data.index');
Route::get('/satu-data/export-csv', [DataController::class, 'exportCsv'])->name('satu-data.export-csv');

// Inovasi: Sistem Verifikasi Dokumen & Surat Ber-QR Code
Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
    Route::get('/', [VerifikasiController::class, 'index'])->name('index');
    Route::get('/{kode}', [VerifikasiController::class, 'show'])->name('show');
});
Route::get('/validasi/{kode}', [VerifikasiController::class, 'show'])->name('validasi.show');
