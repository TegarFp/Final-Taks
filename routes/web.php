<?php

use App\Http\Controllers\PaketController;
use App\Http\Controllers\SatuanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(SatuanController::class)->group(function () {
    Route::get('/dashboard', 'index');
    Route::post('/satuan', 'store');
    Route::get('/satuan/{id}', 'show');
    Route::post('/satuan-update/{id}', 'update');
    Route::put('/update-aktif/{id}', 'aktif');
});

Route::controller(PaketController::class)->group(function () {
    Route::get('/pakets', 'index');
    Route::post('/tambah-paket', 'store');
    Route::post('/paket/{id}', 'update');
    Route::put('/aktif-paket/{id}', 'aktif');
});