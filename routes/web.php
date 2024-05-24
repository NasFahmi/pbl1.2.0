<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');
Route::prefix('admin')->group(function () {
    Route::get('dashboard', App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
 });
Route::get('/test', function(){
    return view('test');
})->name('test');
