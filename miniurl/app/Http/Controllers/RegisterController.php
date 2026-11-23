<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $registerRequest) {

        $user = User::create($registerRequest->validated());

        Auth::login($user);

        return redirect('/');
        
    }
}
