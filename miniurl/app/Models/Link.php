<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['original_url', 'short_url'];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public static function createWithShortUrl(array $attributes) {
        $shortUrl = $attributes['custom_url'] ?? Str::random(8);

        return self::create([
            'original_url' => $attributes['url'],
            'short_url' => $shortUrl
        ]);
    }
}
