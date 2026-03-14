<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home.index')->name('home');

Route::redirect('/blog', '/artikel');
Route::livewire('/artikel', 'pages::artikel.index')->name('blog');
Route::livewire('/artikel/{slug}', 'pages::artikel.detail')->name('artikel.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('dashboard', '/portal');
    Route::view('portal', 'pages.dashboard.index')->name('dashboard');

    Route::livewire('/portal/artikel', 'pages::portal.artikel.index')->name('portal.artikel.index');
    Route::livewire('/portal/artikel/buat', 'pages::portal.artikel.create')->name('portal.artikel.create');
    Route::livewire('/portal/artikel/{id}/edit', 'pages::portal.artikel.edit')->name('portal.artikel.edit');
});

require __DIR__.'/settings.php';
