<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['original_url', 'short_url', 'user_id'];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;


    public function user() {
        return $this->belongsTo(User::class);
    }
}
