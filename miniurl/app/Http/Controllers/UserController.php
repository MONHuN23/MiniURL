<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function createUser(Request $request) {
        $userInfo = $request->validate([
            'name' => ['required', 'min:4', 'max:16'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:20']
        ]);

        User::create($userInfo);

        return response("A következő felhasználó létrehozva: " . $userInfo['name']);
    }

    public function loginUser(Request $request) {}
}
