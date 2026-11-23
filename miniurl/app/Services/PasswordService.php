<?php

namespace App\Services;

use App\Models\Password;
use Illuminate\Support\Str;

class PasswordService
{
    /**
     * Create a new class instance.
     */
    public function generatePassword(array $data) : array
    {
        if(empty($data['password'])) {
            $data['password'] = Str::password(12);
        }
        return $data;
    }
}
