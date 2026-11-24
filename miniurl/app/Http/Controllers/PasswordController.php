<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePasswordRequest;
use App\Http\Requests\UpdatetePasswordRequest;
use App\Models\Password;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $passwords = $request->user()->passwords()->get();

        return view('passwords', [
            'passwords' => $passwords
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PasswordService $service, CreatePasswordRequest $request)
    {
        $filledPassword = $request->filled('password');
        $data = $service->generatePassword($request->validated());
        //Password::create($data);
        $request->user()->passwords()->create($data); //Laravel automatically adds the user_id this way
        return back()->with('success', $filledPassword ? 'Password created successfully!' : 'Password created successfully!(Auto generated password)');
    }

    /**
     * Display the specified resource.
     */
    public function show(Password $password)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetePasswordRequest $request, PasswordService $service, Password $password)
    {
        Gate::authorize('update', $password);
        $data = $service->generatePassword($request->validated());
        $changes = $service->updatePassword($password, $data);
        return back()->with('changes', $changes)->with('success', 'Password updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Password $password)
    {
        Gate::authorize('delete', $password);
        $password->delete();
        return back()->with('success', 'Password deleted successfully!');
    }
}
