<?php

namespace App\Services;
use App\Models\MagicLink;
use Carbon\Carbon;
use App\Models\User;

class MagicLinkService
{
    /**
     * Create a new class instance.
     */
    public function generateMagicLink(int $userId) : MagicLink
    {
        $data = [
            'link' => bin2hex(random_bytes(16)),
            'user_id' => $userId,
            'expires_at' => Carbon::now()->addMinutes(15), // 15 percig érvényes
        ];

        $magicLink = MagicLink::create($data);

        return $magicLink;
    }

    public function getUserByLink(string $link) {
        $magicLink = MagicLink::where('link', $link)
                                ->where('expires_at', '>', Carbon::now())
                                ->first();

        if (!$magicLink) {
            return null;
        }

        return User::find($magicLink->user_id);
    }

    public function sendPasswordRequestEmail(User $user, MagicLink $magicLink) {
        // Itt implementálhatod az email küldés logikáját, például a Laravel Mail osztály segítségével.
        // Példa:
        \Mail::to($user->email)->send(new \App\Mail\PasswordResetMail($magicLink));
    }
}
