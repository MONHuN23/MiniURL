<?php

namespace App\Services;

use App\Models\Password;
use Illuminate\Support\Str;

class PasswordService
{
    /**
     * Create a new class instance.
     */
    public function generatePassword(array $data): array
    {
        if (empty($data['password'])) {
            $data['password'] = Str::password(12);
        }
        return $data;
    }

    public function updatePassword(Password $password, array $data)
    {
        $password->fill($data);

        $changes = [];
        if ($password->isDirty('name')) {
            $changes['name'] = "Name:{$password->getOriginal('name')} => {$password->name}";
        }
        if ($password->isDirty('account_name')) {
            $changes['account_name'] = "Account Name: {$password->getOriginal('account_name')} => {$password->account_name}";
        }
        $password->save();
        return $changes;
    }
}
