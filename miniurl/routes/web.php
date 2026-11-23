<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('register');
    });
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/links', [LinkController::class, 'index']);
    Route::put('/links/{link}', [LinkController::class, 'updateLink']);
    Route::delete('/links/{link}', [LinkController::class, 'destroy']);
    Route::get('/passwords', [PasswordController::class, 'index']);
    Route::put('/passwords/{password}', [PasswordController::class, 'update']);
    Route::delete('/passwords/{password}', [PasswordController::class, 'destroy']);
    Route::post('/passwords', [PasswordController::class, 'store']);
});

Route::get('/{short_url}', [LinkController::class, 'redirectToOriginal']);
Route::get('/', function () {
    return view('shortener');
});
Route::post('/shortenUrl', [LinkController::class, 'createLink']);
