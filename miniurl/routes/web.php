<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\Auth\Register;
use App\Models\Link;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('shortener');
});

Route::get('/login', function() {
    return view('login');
});

Route::get('/register', function() {
    return view('register');
});


Route::post('/shortenUrl', [LinkController::class, 'createLink']);

Route::post('/loginUser', [UserController::class, 'createLink']);
Route::post('/createUser', [UserController::class, 'createUser']);

Route::get('/{short_url}', function($short_url) {
    $link = Link::where('short_url', $short_url) -> first();

    if (!$link) {
        abort(404);
    }

    $link->increment('clicks');

    return redirect()->away($link->original_url);
});

Route::post('/registerUser', Register::class) -> name('registerUser');

Route::post('/logout', function () {
    Auth::logout();

    return redirect('/');
});

