<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');
Route::prefix('admin')->group(function () {
    Route::get('dashboard', App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');

    Route::get('product', App\Livewire\Admin\Product\Product::class)->name('admin.product');
    Route::get('product/create', App\Livewire\Admin\Product\ProductCreate::class)->name('admin.product.create');
    Route::get('product/{id}', App\Livewire\Admin\Product\ProductDetail::class)->name('admin.product.detail');
    
    Route::get('produksi', App\Livewire\Admin\Produksi\Produksi::class)->name('admin.produksi');

    Route::get('transaksi', App\Livewire\Admin\Product\Product::class)->name('admin.transaksi');
    Route::get('preorder', App\Livewire\Admin\Produksi\Produksi::class)->name('admin.preorder');
    Route::get('hutang', App\Livewire\Admin\Product\Product::class)->name('admin.hutang');
    Route::get('piutang', App\Livewire\Admin\Produksi\Produksi::class)->name('admin.piutang');

    Route::get('beban-kewajiban', App\Livewire\Admin\Product\Product::class)->name('admin.beban-kewajiban');
    Route::get('modal', App\Livewire\Admin\Produksi\Produksi::class)->name('admin.modal');
    Route::get('log-activitas', App\Livewire\Admin\Product\Product::class)->name('admin.log-activitas');

 });
Route::get('/test', function(){
    return view('test');
})->name('test');

