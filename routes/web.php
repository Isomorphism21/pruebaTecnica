<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContribuyenteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('contribuyentes', ContribuyenteController::class);
