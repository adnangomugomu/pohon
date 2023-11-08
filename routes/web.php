<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('data-pohon', [FrontendController::class, 'dataPohon'])->name('front.pohon');
Route::get('data-pohon/{id}', [FrontendController::class, 'detailPohon'])->name('front.pohon.detail');
Route::get('aduan-masyarakat', [FrontendController::class, 'aduan'])->name('front.aduan');
Route::post('aduan-masyarakat', [FrontendController::class, 'aduanStore'])->name('front.aduan.store');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'store'])->name('login.store')->middleware(['throttle:login', 'guest']);
Route::get('/logout', [AuthController::class, 'destroy'])->name('login.logout')->middleware('auth');

Route::prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('', [ProfilController::class, 'index'])->name('profil');
    Route::put('/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/reset-password/{id}', [ProfilController::class, 'resetPassword'])->name('profil.resetPassword');
    Route::put('/update-foto/{id}', [ProfilController::class, 'updateFoto'])->name('profil.updateFoto');
    Route::post('/get-kab', [ProfilController::class, 'get_kab'])->name('profil.get_kab');
    Route::post('/get-kec', [ProfilController::class, 'get_kec'])->name('profil.get_kec');
    Route::post('/get-kel', [ProfilController::class, 'get_kel'])->name('profil.get_kel');
});

Route::get('/.well-known/pki-validation/D9FCE00BA3865980AD8A6FF950904B04.txt', function () {
    $filePath = public_path('other/ssl/D9FCE00BA3865980AD8A6FF950904B04.txt');
    return response()->file($filePath);
});