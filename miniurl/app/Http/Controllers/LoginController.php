<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $loginRequest) {

        $credentials = $loginRequest->validated();

        if (Auth::attempt($credentials)) {
            $loginRequest->session()->regenerate();

            return redirect('/');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Credentials incorrect, try again!'
        ]);

    }

    public function logout(Request $request) {
        
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
