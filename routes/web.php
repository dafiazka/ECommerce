<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contoh', function () {
    return view('pesan.example');
});

Auth::routes();

//Order
Route::get('/barang', [App\Http\Controllers\BarangController::class, 'index'])->name('barang');
Route::get('/detail/{id}', [App\Http\Controllers\OrderController::class, 'detail'])->name('order');
Route::post('/order/{id}', [App\Http\Controllers\OrderController::class, 'keranjang'])->name('order');
Route::get('/keranjang', [App\Http\Controllers\OrderController::class, 'checkout'])->name('keranjang');
Route::post('/keranjang/kirim/{id}', [App\Http\Controllers\OrderController::class, 'kiriminsert'])->name('kiriminsert');
Route::post('/keranjang/metode/{id}', [App\Http\Controllers\OrderController::class, 'metodeinsert'])->name('metodeinsert');
Route::delete('/keranjang/hapus/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('keranjang');
Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'konfirmasi_checkout'])->name('checkout');
Route::get('/histori', [App\Http\Controllers\OrderController::class, 'histori'])->name('histori');
Route::get('/histori/nota/{id}', [App\Http\Controllers\OrderController::class, 'nota'])->name('nota');

//hak akses adnmin
Route::group(['middleware' => 'admin'], function () {

    //Barang
    Route::get('/barang/tambah', [App\Http\Controllers\BarangController::class, 'add'])->name('tambahbarang');
    Route::post('/barang/tambah', [App\Http\Controllers\BarangController::class, 'addprocess'])->name('tambahbarang');
    Route::get('/barang/edit/{id}', [App\Http\Controllers\BarangController::class, 'edit'])->name('editbarang');
    Route::post('/barang/edit/{id}', [App\Http\Controllers\BarangController::class, 'editprocess'])->name('editbarang');
    Route::delete('/barang/hapus/{id}', [App\Http\Controllers\BarangController::class, 'destroy'])->name('hapusbarang');

    //Pengiriman
    Route::get('/kirim', [App\Http\Controllers\KirimController::class, 'index'])->name('kirim');
    Route::get('/kirim/tambah', [App\Http\Controllers\KirimController::class, 'add'])->name('tambahkirim');
    Route::post('/kirim/tambah', [App\Http\Controllers\KirimController::class, 'addprocess'])->name('tambahkirim');
    Route::get('/kirim/edit/{id}', [App\Http\Controllers\KirimController::class, 'edit'])->name('editkirim');
    Route::post('/kirim/edit/{id}', [App\Http\Controllers\KirimController::class, 'editprocess'])->name('editkirim');
    Route::delete('/kirim/hapus/{id}', [App\Http\Controllers\KirimController::class, 'destroy'])->name('hapuskirim');

    //Pengiriman
    Route::get('/metode', [App\Http\Controllers\MetodeController::class, 'index'])->name('metode');
    Route::get('/metode/tambah', [App\Http\Controllers\MetodeController::class, 'add'])->name('tambahmetode');
    Route::post('/metode/tambah', [App\Http\Controllers\MetodeController::class, 'addprocess'])->name('tambahmetode');
    Route::get('/metode/edit/{id}', [App\Http\Controllers\MetodeController::class, 'edit'])->name('editmetode');
    Route::post('/metode/edit/{id}', [App\Http\Controllers\MetodeController::class, 'editprocess'])->name('editmetode');
    Route::delete('/metode/hapus/{id}', [App\Http\Controllers\MetodeController::class, 'destroy'])->name('hapusmetode');
});


