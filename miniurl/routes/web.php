<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\LinkController;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/{short_url}', function ($short_url) {
    $link = Link::where('short_url', $short_url)->first();

    if (! $link) {
        abort(404);
    }

    $link->increment('clicks');

    return redirect()->away($link->original_url);
})->name('links.redirect');

Route::post('/registerUser', Register::class)->name('registerUser');
Route::post('/loginUser', Login::class)->name('loginUser');

Route::post('/logout', function () {
    Auth::logout();

    return redirect()->route('home');
})->name('logout');
