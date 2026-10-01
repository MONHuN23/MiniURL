<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateUserRequest $request)
    {

        // Create the user
        $user = User::create($request->validated());

        // Log them in
        Auth::login($user);

        // Redirect to home
        return redirect()->route('home')->with('success', 'Sikeres regisztráció!');
    }
}
