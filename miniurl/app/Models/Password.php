<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $table = 'passwords';
    protected $fillable = ['name', 'account_name', 'password', 'user_id'];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected function casts(): array
    {
        return [
            'password' => 'encrypted',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
