<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagicLink extends Model
{
    protected $table = 'magiclinks';

    protected $fillable = [
        'link',
        'user_id',
        'expires_at',
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    public $incrementing = true;

}
