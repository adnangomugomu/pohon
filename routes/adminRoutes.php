<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PohonController;
use App\Http\Controllers\admin\RefJenisController;
use App\Http\Controllers\admin\RegistrasiController;
use App\Http\Controllers\admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'cekRole:1'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

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
        Route::delete('/{id}', [PohonController::class, 'destroy'])->name('admin.pohon.delete');
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

    Route::prefix('role')->group(function(){
        Route::get('/get-table', [RoleController::class, 'getDataTable'])->name('admin.role.getTable');
        Route::get('/', [RoleController::class, 'index'])->name('admin.role');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::get('/detail/{id}', [RoleController::class, 'show'])->name('admin.role.detail');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('/', [RoleController::class, 'store'])->name('admin.role.store');
        Route::put('/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('admin.role.delete');
    });

    Route::prefix('registrasi')->group(function(){
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
