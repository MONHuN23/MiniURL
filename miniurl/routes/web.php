<?php

use App\Http\Controllers\LinkController;
use App\Models\Link;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('shortener');
});

Route::get('/{short_url}', function($short_url) {
    $link = Link::where('short_url', $short_url) -> first();

    if (!$link) {
        abort(404);
    }

    $link->increment('clicks');

    return redirect()->away($link->original_url);
});

Route::post('/shortenUrl', [LinkController::class, 'createLink']);
