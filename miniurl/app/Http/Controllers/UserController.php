<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return view('profile', [
            'user' => $request->user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, UserService $service)
    {
        $changes = $service->updateUser($request->validated(), $request->user());
        return redirect('/profile')->with('changes', $changes)->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, UserService $service)
    {
        $user = $request->user();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $service->deleteUserAndAvatarIfExists($user);
        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
