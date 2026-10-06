<?php

namespace App\Http\Controllers;

use App\Models\MagicLink;
use App\Models\User;
use App\Http\Requests\MagicLinkRequest;
use App\Services\MagicLinkService;

class MagicLinkController extends Controller
{
    public function storeMagicLink(MagicLinkRequest $request, MagicLinkService $magicLinkService) {
        $user = User::where('email', $request->email)->first();

        $magicLink = $magicLinkService->generateMagicLink($user->id);
        
        $magicLinkService->sendPasswordRequestEmail($user, $magicLink);

        // Mivel ez egy webes form submission, redirectelünk egy siker üzenettel
        return redirect()->back()->with('status', 'Amennyiben a megadott e-mail cím regisztrálva van, elküldtük a linket!');
    }

    // A showMagicLink és deleteMagicLink metódusok innen törölve lettek, mert már nincs rájuk szükség.

    public function verifyLink(string $link, MagicLinkService $magicLinkService) {
        $user = $magicLinkService->getUserByLink($link);

        if (!$user) {
            return response()->json(['message' => 'Invalid or expired magic link'], 404);
        }

        return response()->json(['message' => 'Magic link is valid', 'user' => $user], 200);
    }
}


        
    

