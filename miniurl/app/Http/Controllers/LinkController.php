<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;

class LinkController extends Controller
{
    public function createLink(Request $request) {
        $userInfo = $request->validate([
            'url' => ['required', 'url'],
            'custom_url' => ['nullable', 'string', 'min:3', 'max:30', 'unique:links,short_url']
            ]);

        if (empty($userInfo['custom_url'])) {
            $shortUrl = Str::random(8);
        } else {
            $shortUrl = $userInfo['custom_url'];
        }
        
        Link::create([
            'original_url' => $userInfo['url'],
            'short_url' => $shortUrl
        ]);
        
        return "A rövidített url-ed: " . url('/') . "/" . $shortUrl;
    }
}
