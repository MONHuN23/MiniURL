<?php

namespace App\Services;
use App\Models\User;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function updateUser(array $data, User $user)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }
        $user->fill($data);

        $changes = [];
        if ($user->isDirty('name')) {
            $changes['name'] = "Name:{$user->getOriginal('name')} => {$user->name}";
        }
        if ($user->isDirty('email')) {
            $changes['email'] = "Email: {$user->getOriginal('email')} => {$user->email}";
        }
        if ($user->isDirty('avatar')) {
            $changes['avatar'] = "Avatar: {$user->getOriginal('avatar')} => {$user->avatar}";
        }

        $user->save();
        return $changes;
    }
}
