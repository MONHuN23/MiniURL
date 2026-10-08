<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function createLink(Request $request)
    {
        $urlInfo = $request->validate([
            'url' => ['required', 'url'],
            'custom_url' => ['nullable', 'string', 'min:3', 'max:30', 'unique:links,short_url'],
        ]);

        $urlInfo['user_id'] = $request->user()?->id;

        $link = Link::createWithShortUrl($urlInfo);

        return redirect()->route('home')->with([
            'short_url' => url('/'.$link->short_url),
            'original_url' => $link->original_url,
        ]);
    }

    public function index(Request $request)
    {
        $links = $request->user()->links()->latest()->get();

        return view('links.index', compact('links'));
    }
}
