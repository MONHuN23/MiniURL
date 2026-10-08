<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Str;

class LinkService
{
    /**
     * Új link létrehozása rövidített URL-lel.
     */
    public static function createWithShortUrl(array $attributes)
    {
        $shortUrl = $attributes['short_url'] ?? Str::random(8);

        return Link::create([
            'original_url' => $attributes['original_url'],
            'short_url'    => $shortUrl,
            'user_id'      => $attributes['user_id'] ?? null,
            'name'         => $attributes['name'] ?? null,
        ]);
    }
}
