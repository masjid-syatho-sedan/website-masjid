<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home.index')->name('home');

Route::redirect('/blog', '/artikel');
Route::controller(App\Http\Controllers\BlogController::class)
    ->prefix('artikel')
    ->group(function () {
        Route::get('/', 'index')->name('blog');
        // Route::get('/{slug}', 'show')->name('blog.show');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('dashboard', '/portal');
    Route::view('portal', 'pages.dashboard.index')->name('dashboard');
});

require __DIR__.'/settings.php';
