<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PohonController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'cekRole:2'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('pohon')->group(function () {
        Route::get('/get-table', [PohonController::class, 'getDataTable'])->name('admin.pohon.getTable');
        Route::get('/', [PohonController::class, 'index'])->name('admin.pohon');
        Route::get('/create', [PohonController::class, 'create'])->name('admin.pohon.create');
        Route::get('/detail/{id}', [PohonController::class, 'show'])->name('admin.pohon.detail');
        Route::get('/edit/{id}', [PohonController::class, 'edit'])->name('admin.pohon.edit');
        Route::post('/', [PohonController::class, 'store'])->name('admin.pohon.store');
        Route::put('/{id}', [PohonController::class, 'update'])->name('admin.pohon.update');
        Route::delete('/{id}', [PohonController::class, 'destroy'])->name('admin.pohon.delete');
    });

    Route::prefix('referensi-jenis-pohon')->group(function () {
        Route::get('/get-table', [PohonController::class, 'getDataTable'])->name('admin.ref_jenis.getTable');
        Route::get('/', [PohonController::class, 'index'])->name('admin.ref_jenis');
        Route::get('/create', [PohonController::class, 'create'])->name('admin.ref_jenis.create');
        Route::get('/detail/{id}', [PohonController::class, 'show'])->name('admin.ref_jenis.detail');
        Route::get('/edit/{id}', [PohonController::class, 'edit'])->name('admin.ref_jenis.edit');
        Route::post('/', [PohonController::class, 'store'])->name('admin.ref_jenis.store');
        Route::put('/{id}', [PohonController::class, 'update'])->name('admin.ref_jenis.update');
        Route::delete('/{id}', [PohonController::class, 'destroy'])->name('admin.ref_jenis.delete');
    });

    Route::prefix('referensi-kondisi-pohon')->group(function () {
        Route::get('/get-table', [PohonController::class, 'getDataTable'])->name('admin.ref_kondisi.getTable');
        Route::get('/', [PohonController::class, 'index'])->name('admin.ref_kondisi');
        Route::get('/create', [PohonController::class, 'create'])->name('admin.ref_kondisi.create');
        Route::get('/detail/{id}', [PohonController::class, 'show'])->name('admin.ref_kondisi.detail');
        Route::get('/edit/{id}', [PohonController::class, 'edit'])->name('admin.ref_kondisi.edit');
        Route::post('/', [PohonController::class, 'store'])->name('admin.ref_kondisi.store');
        Route::put('/{id}', [PohonController::class, 'update'])->name('admin.ref_kondisi.update');
        Route::delete('/{id}', [PohonController::class, 'destroy'])->name('admin.ref_kondisi.delete');
    });
});
