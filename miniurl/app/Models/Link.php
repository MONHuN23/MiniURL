<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['original_url', 'short_url'];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
}
