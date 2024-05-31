<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ListProdukController;
use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;

Route::get('/listproduk', [ListProdukController::class, 'show'] );

Route::get('/', function () {
    return view('welcome');
});



Route::get('/listproduk', [ListProdukController::class, 'show']);
Route::post('/listproduk', [ListProdukController::class, 'simpan'])->name('produk.simpan');

Route::get('/listproduk/{id}', [ListProdukController::class, 'delete'])->name('produk.delete');



Route::get('api/produk', [ApiController::class, 'index']);
Route::get('api/list', [ApiController::class, 'getProduct']);


