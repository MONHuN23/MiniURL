<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function updateUser(array $data, User $user)
    {
        foreach ($data as $key => $value) {
            if (empty($data[$key])) {
                unset($data[$key]);
            }
        }
        if (isset($data['avatar'])) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = Storage::disk('public')->putFile('avatars', $data['avatar']);
        }

        $user->fill($data);
        $changes = [];

        foreach ($user->getDirty() as $change => $value) {
            $label = ucfirst($change);
            $changes[$change] = match ($change) {
                'password' => 'Password updated',
                'avatar' => "Avatar updated",
                default => "{$label} :{$user->getOriginal($change)} => {$value}"
            };
        }

        $user->save();
        return $changes;
    }
}
