<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\TabelBarang;
use App\Livewire\Transaksi;
use App\Http\Controllers\TabelUser;

Route::group(['middleware' => 'guest'], function(){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

    Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');

});
Route::group(['middleware' => 'auth' ], function(){
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name("dashboard");

    Route::get('/product', [TabelBarang::class, 'index'])->name('product.index');
    Route::get('/product/create', [TabelBarang::class, 'create'])->name('product.create');
    Route::post('/product', [TabelBarang::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [TabelBarang::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [TabelBarang::class, 'update'])->name('product.update');
    Route::get('/product/cancel', function () {
        return redirect()->route('product.index')->without(['success']);
    })->name('product.cancel');
    Route::delete('/product/{id}', [TabelBarang::class, 'destroy'])->name('product.destroy');

    //user
    Route::get('/user', [TabelUser::class, 'index'])->name('user.index');
    Route::post('/user', [TabelUser::class, 'store'])->name('user.store');
    Route::get('/user/create', [TabelUser::class, 'create'])->name('user.create');
    Route::get('/user/{id}/edit', [TabelUser::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [TabelUser::class, 'update'])->name('user.update');
    Route::get('/user/cancel', function () {
        return redirect()->route('user.index')->without(['success']);
    })->name('user.cancel');
    Route::delete('/user/{id}', [TabelUser::class, 'destroy'])->name('user.destroy');

     //pelanggan
     Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
     Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
     Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
     Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
     Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
     Route::get('/pelanggan/cancel', function () {
         return redirect()->route('pelanggan.index')->without(['success']);
     })->name('pelanggan.cancel');
     Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');


    // Route::resource('/table_barang', TabelBarangController::class);
    Route::get('/transaksi', Transaksi::class)->name('transaksi');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/{id}', [LaporanController::class, 'detail'])->name('laporan.detail');
    Route::get('/cetakdetail/{id}', [LaporanController::class, 'cetakdetail'])->name('cetak.detail');
    Route::get('/cetak', [LaporanController::class, 'cetak'])->name('cetak');

});


// Route::group(['prefix' => 'admin','middleware' => ['auth'], 'as'=> 'admin.'], function(){
// });
// Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name("dashboard");

