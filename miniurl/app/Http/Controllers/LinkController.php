<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;

class LinkController extends Controller
{
    public function createLink(Request $request) {
        $urlInfo = $request->validate([
            'url' => ['required', 'url'],
            'custom_url' => ['nullable', 'string', 'min:3', 'max:30', 'unique:links,short_url']
        ]);

        
        $link = Link::createWithShortUrl($urlInfo);

        return response("A rövidített url-ed: " . url('/') . "/" . $link->short_url);
    }
}
