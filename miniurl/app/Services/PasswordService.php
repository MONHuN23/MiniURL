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

        foreach ($password->getDirty() as $change=> $value) {
            $label = Str::headline($change);
            $changes[$change] = match($change) {
                'password' => 'Password updated',
                default => "{$label}: {$password->getOriginal($change)} => {$value}"
            };
        }

        if (empty($changes)) {
            $changes['no_changes'] = 'No changes were made.';
        }
        
        $password->save();
        return $changes;
    }
}
