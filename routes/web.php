<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\DataKontroler;
use App\Http\Controllers\ListProdukController;

//Route::get('/listbarang/{id}/{nama}', function ($id, $nama) {
//    return view('list_barang', compact('id', 'nama'));
// });

// Route::get('/user/{id}', function ($id) {
//     return 'User dengan ID' . $id;
// });

// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', function() {
//         return 'Admin Dashboard';
//     });

//     Route::get('/users', function() {
//         return 'Admin Users';
//     });
// });

Route::get('/', function () {
    return view('pages.home');
});

// Route::get('/namaview', [DataKontroler::class, 'tampilkan']);
// // Route::get('/listbarang/{id}/{nama}', [ListBarangController::class, 'tampilkan']);
// Route::get('/', [HomeController::class, 'index']);
// Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/produk', [ListProdukController::class, 'index'])->name('produk.index');
Route::post('/produk/simpan', [ListProdukController::class, 'simpan'])->name('produk.simpan');
Route::put('/produk/{id}', [ListProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [ListProdukController::class, 'delete'])->name('produk.delete');
