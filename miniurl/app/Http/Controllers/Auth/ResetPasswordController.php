<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\MagicLink;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function showResetForm($link)
    {
        // Először ellenőrizzük, hogy létezik-e és érvényes-e a link
        $magicLink = MagicLink::where('link', $link)->first();

        if (!$magicLink || Carbon::now()->greaterThan($magicLink->expires_at)) {
            abort(404, 'A jelszó visszaállító link érvénytelen vagy lejárt.');
        }

        return view('auth.reset-password', ['link' => $link]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $magicLink = MagicLink::where('link', $request->link)->first();

        if (!$magicLink) {
            return redirect()->route('home')->withErrors(['Hibás vagy nem létező link.']);
        }

        // Ellenőrizzük, hogy nem járt-e le
        if (Carbon::now()->greaterThan($magicLink->expires_at)) {
            $magicLink->delete(); // Töröljük, ha lejárt
            return redirect()->route('home')->withErrors(['A jelszó visszaállító link lejárt! Kérlek, kérj egy újat.']);
        }

        $user = User::find($magicLink->user_id);

        if (!$user) {
            return redirect()->route('home')->withErrors(['Felhasználó nem található.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        // Töröljük a linket, hogy ne lehessen többször felhasználni!
        $magicLink->delete();

        return redirect()->route('home')->with('success', 'Sikeres jelszó módosítás!');
    }
}
