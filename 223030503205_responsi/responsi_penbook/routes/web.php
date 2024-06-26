<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EBookController;

Route::get('/', function () {
    return view('welcome');
});
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});


Route::get('/ebooks', [\App\Http\Controllers\EBookController::class, 'index'])->name('ebooks.index');
Route::resource('ebooks', EBookController::class);
Route::get('/search', [EBookController::class, 'search'])->name('ebooks.search');




