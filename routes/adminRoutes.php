<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FotoPohonController;
use App\Http\Controllers\admin\LaporanInternalController;
use App\Http\Controllers\admin\LaporanMasyarakatController;
use App\Http\Controllers\admin\PohonController;
use App\Http\Controllers\admin\RefAduanController;
use App\Http\Controllers\admin\RefAkarController;
use App\Http\Controllers\admin\RefJenisController;
use App\Http\Controllers\admin\RefKondisiController;
use App\Http\Controllers\admin\RefTajukController;
use App\Http\Controllers\admin\RegistrasiController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\PetaController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'cekRole:1'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/grafik-laporan', [DashboardController::class, 'grafik_laporan'])->name('admin.grafik_laporan');
    });

    Route::prefix('pohon')->group(function () {
        Route::get('/get-table', [PohonController::class, 'getDataTable'])->name('admin.pohon.getTable');
        Route::get('/', [PohonController::class, 'index'])->name('admin.pohon');
        Route::get('/create', [PohonController::class, 'create'])->name('admin.pohon.create');
        Route::get('/detail/{id}', [PohonController::class, 'show'])->name('admin.pohon.detail');
        Route::get('/edit/{id}', [PohonController::class, 'edit'])->name('admin.pohon.edit');
        Route::get('/peta/{id}', [PohonController::class, 'peta'])->name('admin.pohon.peta');
        Route::get('/export-excel', [PohonController::class, 'export'])->name('admin.pohon.excel');
        Route::post('/', [PohonController::class, 'store'])->name('admin.pohon.store');
        Route::put('/{id}', [PohonController::class, 'update'])->name('admin.pohon.update');
        Route::put('/verifikasi/{id}', [PohonController::class, 'verifikasi'])->name('admin.pohon.verif');
        Route::delete('/{id}', [PohonController::class, 'destroy'])->name('admin.pohon.delete');
    });

    Route::prefix('peta')->group(function () {
        Route::get('/', [PetaController::class, 'index'])->name('admin.peta');
        Route::get('/geojson', [PetaController::class, 'geojson'])->name('admin.peta.geojson');
        Route::post('/jarak', [PetaController::class, 'jarak'])->name('admin.peta.jarak');
    });

    Route::prefix('pohon-foto')->group(function () {
        Route::get('/{id}', [FotoPohonController::class, 'show'])->name('admin.pohon.foto');
        Route::get('/get-table/{id}', [FotoPohonController::class, 'getDataTable'])->name('admin.pohon.foto.getTable');
        Route::post('/{id}', [FotoPohonController::class, 'store'])->name('admin.pohon.foto.store');
        Route::put('/{id}', [FotoPohonController::class, 'update'])->name('admin.pohon.foto.update');
        Route::delete('/{id}', [FotoPohonController::class, 'destroy'])->name('admin.pohon.foto.delete');
    });

    Route::prefix('referensi-jenis-pohon')->group(function () {
        Route::get('/get-table', [RefJenisController::class, 'getDataTable'])->name('admin.ref_jenis.getTable');
        Route::get('/', [RefJenisController::class, 'index'])->name('admin.ref_jenis');
        Route::get('/create', [RefJenisController::class, 'create'])->name('admin.ref_jenis.create');
        Route::get('/detail/{id}', [RefJenisController::class, 'show'])->name('admin.ref_jenis.detail');
        Route::get('/edit/{id}', [RefJenisController::class, 'edit'])->name('admin.ref_jenis.edit');
        Route::post('/', [RefJenisController::class, 'store'])->name('admin.ref_jenis.store');
        Route::put('/{id}', [RefJenisController::class, 'update'])->name('admin.ref_jenis.update');
        Route::delete('/{id}', [RefJenisController::class, 'destroy'])->name('admin.ref_jenis.delete');
    });

    Route::prefix('referensi-akar-pohon')->group(function () {
        Route::get('/get-table', [RefAkarController::class, 'getDataTable'])->name('admin.ref_akar.getTable');
        Route::get('/', [RefAkarController::class, 'index'])->name('admin.ref_akar');
        Route::get('/create', [RefAkarController::class, 'create'])->name('admin.ref_akar.create');
        Route::get('/detail/{id}', [RefAkarController::class, 'show'])->name('admin.ref_akar.detail');
        Route::get('/edit/{id}', [RefAkarController::class, 'edit'])->name('admin.ref_akar.edit');
        Route::post('/', [RefAkarController::class, 'store'])->name('admin.ref_akar.store');
        Route::put('/{id}', [RefAkarController::class, 'update'])->name('admin.ref_akar.update');
        Route::delete('/{id}', [RefAkarController::class, 'destroy'])->name('admin.ref_akar.delete');
    });

    Route::prefix('referensi-kondisi-pohon')->group(function () {
        Route::get('/get-table', [RefKondisiController::class, 'getDataTable'])->name('admin.ref_kondisi.getTable');
        Route::get('/', [RefKondisiController::class, 'index'])->name('admin.ref_kondisi');
        Route::get('/create', [RefKondisiController::class, 'create'])->name('admin.ref_kondisi.create');
        Route::get('/detail/{id}', [RefKondisiController::class, 'show'])->name('admin.ref_kondisi.detail');
        Route::get('/edit/{id}', [RefKondisiController::class, 'edit'])->name('admin.ref_kondisi.edit');
        Route::post('/', [RefKondisiController::class, 'store'])->name('admin.ref_kondisi.store');
        Route::put('/{id}', [RefKondisiController::class, 'update'])->name('admin.ref_kondisi.update');
        Route::delete('/{id}', [RefKondisiController::class, 'destroy'])->name('admin.ref_kondisi.delete');
    });

    Route::prefix('referensi-jenis-aduan')->group(function () {
        Route::get('/get-table', [RefAduanController::class, 'getDataTable'])->name('admin.ref_aduan.getTable');
        Route::get('/', [RefAduanController::class, 'index'])->name('admin.ref_aduan');
        Route::get('/create', [RefAduanController::class, 'create'])->name('admin.ref_aduan.create');
        Route::get('/detail/{id}', [RefAduanController::class, 'show'])->name('admin.ref_aduan.detail');
        Route::get('/edit/{id}', [RefAduanController::class, 'edit'])->name('admin.ref_aduan.edit');
        Route::post('/', [RefAduanController::class, 'store'])->name('admin.ref_aduan.store');
        Route::put('/{id}', [RefAduanController::class, 'update'])->name('admin.ref_aduan.update');
        Route::delete('/{id}', [RefAduanController::class, 'destroy'])->name('admin.ref_aduan.delete');
    });

    Route::prefix('referensi-tajuk')->group(function () {
        Route::get('/get-table', [RefTajukController::class, 'getDataTable'])->name('admin.ref_tajuk.getTable');
        Route::get('/', [RefTajukController::class, 'index'])->name('admin.ref_tajuk');
        Route::get('/create', [RefTajukController::class, 'create'])->name('admin.ref_tajuk.create');
        Route::get('/detail/{id}', [RefTajukController::class, 'show'])->name('admin.ref_tajuk.detail');
        Route::get('/edit/{id}', [RefTajukController::class, 'edit'])->name('admin.ref_tajuk.edit');
        Route::post('/', [RefTajukController::class, 'store'])->name('admin.ref_tajuk.store');
        Route::put('/{id}', [RefTajukController::class, 'update'])->name('admin.ref_tajuk.update');
        Route::delete('/{id}', [RefTajukController::class, 'destroy'])->name('admin.ref_tajuk.delete');
    });

    Route::prefix('laporan-internal')->group(function () {
        Route::get('/get-table', [LaporanInternalController::class, 'getDataTable'])->name('admin.laporan_internal.getTable');
        Route::get('/', [LaporanInternalController::class, 'index'])->name('admin.laporan_internal');
        Route::get('/create', [LaporanInternalController::class, 'create'])->name('admin.laporan_internal.create');
        Route::get('/detail/{id}', [LaporanInternalController::class, 'show'])->name('admin.laporan_internal.detail');
        Route::get('/edit/{id}', [LaporanInternalController::class, 'edit'])->name('admin.laporan_internal.edit');
        Route::get('/export-excel', [LaporanInternalController::class, 'export'])->name('admin.laporan_internal.excel');
        Route::post('/', [LaporanInternalController::class, 'store'])->name('admin.laporan_internal.store');
        Route::put('/{id}', [LaporanInternalController::class, 'update'])->name('admin.laporan_internal.update');
        Route::put('/verifikasi/{id}', [LaporanInternalController::class, 'verifikasi'])->name('admin.laporan_internal.verif');
        Route::delete('/{id}', [LaporanInternalController::class, 'destroy'])->name('admin.laporan_internal.delete');
    });

    Route::prefix('laporan-masyarakat')->group(function () {
        Route::get('/get-table', [LaporanMasyarakatController::class, 'getDataTable'])->name('admin.laporan_masyarakat.getTable');
        Route::get('/', [LaporanMasyarakatController::class, 'index'])->name('admin.laporan_masyarakat');
        Route::get('/detail/{id}', [LaporanMasyarakatController::class, 'show'])->name('admin.laporan_masyarakat.detail');
        Route::get('/export-excel', [LaporanMasyarakatController::class, 'export'])->name('admin.laporan_masyarakat.excel');
        Route::put('/verifikasi/{id}', [LaporanMasyarakatController::class, 'verifikasi'])->name('admin.laporan_masyarakat.verif');
        Route::delete('/{id}', [LaporanMasyarakatController::class, 'destroy'])->name('admin.laporan_masyarakat.delete');
    });

    Route::prefix('role')->group(function () {
        Route::get('/get-table', [RoleController::class, 'getDataTable'])->name('admin.role.getTable');
        Route::get('/', [RoleController::class, 'index'])->name('admin.role');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::get('/detail/{id}', [RoleController::class, 'show'])->name('admin.role.detail');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('/', [RoleController::class, 'store'])->name('admin.role.store');
        Route::put('/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('admin.role.delete');
    });

    Route::prefix('registrasi')->group(function () {
        Route::get('/get-table', [RegistrasiController::class, 'getDataTable'])->name('admin.registrasi.getTable');
        Route::get('/reset-password/{id}', [RegistrasiController::class, 'resetPassword'])->name('admin.registrasi.resetPassword');
        Route::get('/', [RegistrasiController::class, 'index'])->name('admin.registrasi');
        Route::get('/create', [RegistrasiController::class, 'create'])->name('admin.registrasi.create');
        Route::get('/detail/{id}', [RegistrasiController::class, 'show'])->name('admin.registrasi.detail');
        Route::get('/edit/{id}', [RegistrasiController::class, 'edit'])->name('admin.registrasi.edit');
        Route::post('/', [RegistrasiController::class, 'store'])->name('admin.registrasi.store');
        Route::delete('/{id}', [RegistrasiController::class, 'destroy'])->name('admin.registrasi.delete');
    });
});
