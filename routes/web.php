<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', App\Livewire\Auth\Login::class)->name('login');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::middleware(['role:superadmin|admin'])->group(function () {
        Route::get('dashboard', App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
    });
    Route::middleware(['role:superadmin|admin'])->group(function () {
        Route::get('product', App\Livewire\Admin\Product\Product::class)->name('admin.product');
        Route::get('product/create', App\Livewire\Admin\Product\ProductCreate::class)->name('admin.product.create');
        Route::get('product/{id}', App\Livewire\Admin\Product\ProductDetail::class)->name('admin.product.detail');
    });
    Route::middleware(['role:superadmin', 'permission:edit-product|hapus-product'])->group(function () {
        Route::get('product/{id}/edit', App\Livewire\Admin\Product\ProductEdit::class)->name('admin.product.edit');
    });
    Route::middleware(['role:superadmin|admin'])->group(function () {
        Route::get('produksi', App\Livewire\Admin\Produksi\Produksi::class)->name('admin.produksi');
        Route::get('produksi/create', App\Livewire\Admin\Produksi\ProduksiCreate::class)->name('admin.produksi.create');
        Route::get('produksi/{id}/edit', App\Livewire\Admin\Produksi\ProduksiEdit::class)->name('admin.produksi.edit');
    });

    Route::middleware(['role:superadmin|admin'])->group(function () {
        Route::get('transaksi', App\Livewire\Admin\Product\Product::class)->name('admin.transaksi');
    });

    Route::middleware(['role:superadmin|admin'])->group(function () {
        Route::get('preorder', App\Livewire\Admin\Produksi\Produksi::class)->name('admin.preorder');
    });
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('hutang', App\Livewire\Admin\Product\Product::class)->name('admin.hutang');
    });
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('piutang', App\Livewire\Admin\Produksi\Produksi::class)->name('admin.piutang');
    });
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('beban-kewajiban', App\Livewire\Admin\BebanKewajiban\BebanKewajiban::class)->name('admin.beban-kewajiban');
        Route::get('beban-kewajiban/create', App\Livewire\Admin\BebanKewajiban\BebanKewajibanCreate::class)->name('admin.beban-kewajiban.create');
        Route::get('beban-kewajiban/{id}/edit', App\Livewire\Admin\BebanKewajiban\BebanKewajibanEdit::class)->name('admin.beban-kewajiban.edit');
    });
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('modal', App\Livewire\Admin\Produksi\Produksi::class)->name('admin.modal');
    });
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('log-activitas', App\Livewire\Admin\LogAktivitas\LogAktivitas::class)->name('admin.log-activitas');
    });
});
Route::get('/test', function () {
    return view('test');
})->name('test');
