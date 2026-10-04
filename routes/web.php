<?php

use App\Http\Controllers\CsvUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [StoreController::class, 'index'])->name('dashboard');
    Route::resource('stores', StoreController::class);
    Route::get('/stores/{store}/upload', [CsvUploadController::class, 'create'])->name('stores.upload