<?php

use Illuminate\Support\Facades\Route;

Route::prefix('operator')->middleware(['auth','cekRole:3'])->group(function () {

    
});
