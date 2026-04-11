<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home.index')->name('home');

Route::view('/fasilitas', 'pages.fasilitas.index')->name('fasilitas');
Route::view('/fasilitas/ambulans', 'pages.fasilitas.ambulans')->name('fasilitas.ambulans');
Route::livewire('/fasilitas/ambulans/jurnal', 'pages::fasilitas.ambulans-jurnal')->name('fasilitas.ambulans.jurnal');

Route::redirect('/blog', '/artikel');
Route::livewire('/artikel', 'pages::artikel.index')->name('blog');
Route::livewire('/artikel/{slug}', 'pages::artikel.detail')->name('artikel.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('dashboard', '/portal');
    Route::view('portal', 'pages.dashboard.index')->name('dashboard');

});

Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('auth.google.callback');

require __DIR__.'/settings.php';
