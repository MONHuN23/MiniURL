<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Str;

class LinkService
{
    /**
     * Create a new class instance.
     */
    public function generateLink(array $data, ?int $user_id = null) : Link
    {
        if (empty($data['custom_url'])) {
            $shortUrl = Str::random(8);
        } else {
            $shortUrl = $data['custom_url'];
        }
        
        $link = Link::create([
            'original_url' => $data['url'],
            'short_url' => $shortUrl,
            'user_id' => $user_id
        ]);

        return $link;
    }

    public function findLinkAndIncrementClicks(string $shortUrl) : Link {
        $link = Link::where('short_url', $shortUrl) -> firstOrFail();

        $link->increment('clicks');

        return $link;
    }

    public function generateShortUrlIfNotExists(link $link, array $data) : Link {
        if (empty($data['short_url'])) {
            $data['short_url'] = Str::random(8);
        }
        $link->update($data);
        return $link;
    }
}
