<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\LinkController;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagicLinkController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('shortener');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/shortenUrl', [LinkController::class, 'createLink'])->name('shortenUrl');
Route::get('/links', [LinkController::class, 'index'])->middleware('auth')->name('links.index');
Route::patch('/links/{id}', [LinkController::class, 'updateLink'])->middleware('auth')->name('links.update');
Route::delete('/links/{id}', [LinkController::class, 'deleteLink'])->middleware('auth')->name('links.destroy');

Route::post('/registerUser', Register::class)->name('registerUser');
Route::post('/loginUser', Login::class)->name('loginUser');

Route::get('/magic-verify/{link}', [MagicLinkController::class, 'verifyLink'])->name('magic.verify');
Route::post('/magic-links', [MagicLinkController::class, 'storeMagicLink'])->name('magic.store');

Route::post('/logout', function () {
    Auth::logout();

    return redirect()->route('home');
})->name('logout');

Route::get('/forgot-password', function () { return view('auth.forgot-password'); })->name('password.request');
Route::get('/resetpassword/{link}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/resetpassword', [ResetPasswordController::class, 'reset'])->name('password.update');

// FIGYELEM: Ennek a catch-all route-nak MINTIG legalul kell lennie!
Route::get('/{short_url}', function ($short_url) {
    $link = Link::where('short_url', $short_url)->first();

    if (! $link) {
        abort(404);
    }

    $link->increment('clicks');

    return redirect()->away($link->original_url);
})->name('links.redirect');
