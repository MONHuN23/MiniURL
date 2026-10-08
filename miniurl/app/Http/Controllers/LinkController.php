<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Http\Requests\LinkRequest;
use App\Services\LinkService;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function createLink(LinkRequest $request, LinkService $linkService)
    {
        $urlInfo = $request->validated();
        $urlInfo['user_id'] = $request->user()?->id;

        $link = $linkService->createWithShortUrl($urlInfo);

        return redirect()->route('home')->with([
            'short_url' => url('/'.$link->short_url),
            'original_url' => $link->original_url,
            'name' => $link->name,
        ]);
    }

    public function index(Request $request)
    {
        $links = Link::where('user_id', $request->user()->id)->latest()->get();

        return view('links.index', compact('links'));
    }

    public function updateLink(LinkRequest $request, int $id)
    {
        $link = Link::findOrFail($id);

        $link->update($request->validated());

        return redirect()->back()->with('success', 'A link sikeresen módosítva!');
    }

    public function deleteLink(int $id)
    {
        $link = Link::findOrFail($id);

        $link->delete();

        return redirect()->back()->with('success', 'A link sikeresen törölve!');
    }
}
