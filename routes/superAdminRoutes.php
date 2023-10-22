<?php

use App\Http\Controllers\super_admin\RegistrasiController;
use App\Http\Controllers\super_admin\DashboardController;
use App\Http\Controllers\super_admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('super-admin')->middleware(['auth','cekRole:1'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('super_admin.dashboard');

    Route::prefix('role')->group(function(){
        Route::get('/get-table', [RoleController::class, 'getDataTable'])->name('super_admin.role.getTable');
        Route::get('/', [RoleController::class, 'index'])->name('super_admin.role');
        Route::get('/create', [RoleController::class, 'create'])->name('super_admin.role.create');
        Route::get('/detail/{id}', [RoleController::class, 'show'])->name('super_admin.role.detail');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('super_admin.role.edit');
        Route::post('/', [RoleController::class, 'store'])->name('super_admin.role.store');
        Route::put('/{id}', [RoleController::class, 'update'])->name('super_admin.role.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('super_admin.role.delete');
    });

    Route::prefix('registrasi')->group(function(){
        Route::get('/get-table', [RegistrasiController::class, 'getDataTable'])->name('super_admin.registrasi.getTable');
        Route::get('/reset-password/{id}', [RegistrasiController::class, 'resetPassword'])->name('super_admin.registrasi.resetPassword');
        Route::get('/', [RegistrasiController::class, 'index'])->name('super_admin.registrasi');
        Route::get('/create', [RegistrasiController::class, 'create'])->name('super_admin.registrasi.create');
        Route::get('/detail/{id}', [RegistrasiController::class, 'show'])->name('super_admin.registrasi.detail');
        Route::get('/edit/{id}', [RegistrasiController::class, 'edit'])->name('super_admin.registrasi.edit');
        Route::post('/', [RegistrasiController::class, 'store'])->name('super_admin.registrasi.store');
        Route::delete('/{id}', [RegistrasiController::class, 'destroy'])->name('super_admin.registrasi.delete');
    });
});
