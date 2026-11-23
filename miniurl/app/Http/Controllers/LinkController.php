<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use App\Services\LinkService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function createLink(CreateLinkRequest $request, LinkService $linkService)
    {

        $link = $linkService->generateLink($request->validated(), Auth::id());

        return response("A rövidített url-ed: " . url('/') . "/" . $link->short_url);
    }

    public function index(Request $request)
    {

        //Equals: $links = Link::where('user_id', $request->user()->id());
        $links = $request->user()->links()->get();

        return view('links', [
            'links' => $links,
        ]);
    }

    public function destroy(Link $link)
    {
        // equals: $link = Link::where($id, 'id'); if you pass the id as the parameter, but this is better: Link::where('id', $id)->firstOrFail()
        Gate::authorize('delete', $link);
        $link->delete();
        return redirect('/links');
    }

    public function redirectToOriginal(string $short_url, LinkService $service)
    {
        $link = $service->findLinkAndIncrementClicks($short_url);

        return redirect()->away($link->original_url);
    }

    public function updateLink(UpdateLinkRequest $request, LinkService $service, Link $link)
    {

        Gate::authorize('update', $link);

        $service->generateShortUrlIfNotExists($link, $request->validated());

        return redirect('/links');
    }
}
