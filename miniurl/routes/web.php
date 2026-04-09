<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('shortener');
});

Route::post('/shortenUrl', [LinkController::class, 'createLink']);
