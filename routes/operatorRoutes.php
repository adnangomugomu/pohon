<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\admin\PohonController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FotoPohonController;
use App\Http\Controllers\admin\LaporanInternalController;
use App\Http\Controllers\admin\LaporanMasyarakatController;

Route::prefix('operator')->middleware(['auth', 'cekRole:2'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('operator.dashboard');
        Route::post('/grafik-laporan', [DashboardController::class, 'grafik_laporan'])->name('operator.grafik_laporan');
    });

    Route::prefix('pohon')->group(function () {
        Route::get('/get-table', [PohonController::class, 'getDataTable'])->name('operator.pohon.getTable');
        Route::get('/', [PohonController::class, 'index'])->name('operator.pohon');
        Route::get('/create', [PohonController::class, 'create'])->name('operator.pohon.create');
        Route::get('/detail/{id}', [PohonController::class, 'show'])->name('operator.pohon.detail');
        Route::get('/edit/{id}', [PohonController::class, 'edit'])->name('operator.pohon.edit');
        Route::get('/peta/{id}', [PohonController::class, 'peta'])->name('operator.pohon.peta');
        Route::get('/export-excel', [PohonController::class, 'export'])->name('operator.pohon.excel');
        Route::post('/', [PohonController::class, 'store'])->name('operator.pohon.store');
        Route::put('/{id}', [PohonController::class, 'update'])->name('operator.pohon.update');
        Route::put('/verifikasi/{id}', [PohonController::class, 'verifikasi'])->name('operator.pohon.verif');
        Route::delete('/{id}', [PohonController::class, 'destroy'])->name('operator.pohon.delete');
    });

    Route::prefix('peta')->group(function () {
        Route::get('/', [PetaController::class, 'index'])->name('operator.peta');
        Route::get('/geojson', [PetaController::class, 'geojson'])->name('operator.peta.geojson');
        Route::post('/jarak', [PetaController::class, 'jarak'])->name('operator.peta.jarak');
    });

    Route::prefix('pohon-foto')->group(function () {
        Route::get('/{id}', [FotoPohonController::class, 'show'])->name('operator.pohon.foto');
        Route::get('/get-table/{id}', [FotoPohonController::class, 'getDataTable'])->name('operator.pohon.foto.getTable');
        Route::post('/{id}', [FotoPohonController::class, 'store'])->name('operator.pohon.foto.store');
        Route::put('/{id}', [FotoPohonController::class, 'update'])->name('operator.pohon.foto.update');
        Route::delete('/{id}', [FotoPohonController::class, 'destroy'])->name('operator.pohon.foto.delete');
    });

    Route::prefix('laporan-internal')->group(function () {
        Route::get('/get-table', [LaporanInternalController::class, 'getDataTable'])->name('operator.laporan_internal.getTable');
        Route::get('/', [LaporanInternalController::class, 'index'])->name('operator.laporan_internal');
        Route::get('/create', [LaporanInternalController::class, 'create'])->name('operator.laporan_internal.create');
        Route::get('/detail/{id}', [LaporanInternalController::class, 'show'])->name('operator.laporan_internal.detail');
        Route::get('/edit/{id}', [LaporanInternalController::class, 'edit'])->name('operator.laporan_internal.edit');
        Route::get('/export-excel', [LaporanInternalController::class, 'export'])->name('operator.laporan_internal.excel');
        Route::post('/', [LaporanInternalController::class, 'store'])->name('operator.laporan_internal.store');
        Route::put('/{id}', [LaporanInternalController::class, 'update'])->name('operator.laporan_internal.update');
        Route::put('/verifikasi/{id}', [LaporanInternalController::class, 'verifikasi'])->name('operator.laporan_internal.verif');
        Route::delete('/{id}', [LaporanInternalController::class, 'destroy'])->name('operator.laporan_internal.delete');
    });

    Route::prefix('laporan-masyarakat')->group(function () {
        Route::get('/get-table', [LaporanMasyarakatController::class, 'getDataTable'])->name('operator.laporan_masyarakat.getTable');
        Route::get('/', [LaporanMasyarakatController::class, 'index'])->name('operator.laporan_masyarakat');
        Route::get('/detail/{id}', [LaporanMasyarakatController::class, 'show'])->name('operator.laporan_masyarakat.detail');
        Route::get('/export-excel', [LaporanMasyarakatController::class, 'export'])->name('operator.laporan_masyarakat.excel');
        Route::put('/verifikasi/{id}', [LaporanMasyarakatController::class, 'verifikasi'])->name('operator.laporan_masyarakat.verif');
        Route::delete('/{id}', [LaporanMasyarakatController::class, 'destroy'])->name('operator.laporan_masyarakat.delete');
    });
});
