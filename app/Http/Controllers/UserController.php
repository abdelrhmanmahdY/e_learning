<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;


use Illuminate\Routing\Controller as BaseController;

use App\Http\Middleware\CheckUserRole; // Import the middleware



class UserController extends Controller

{





    /**
     * Display the user profile.
     */
    public function index(): View
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }
        $users = User::with('penalties')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for editing the user profile.
     */
    // public function edit(): View
    // {
    //     $user = Auth::user(); // Get the authenticated user
    //     return view('user.edit', compact('user'));
    // }

    // /**
    //  * Update the user profile.
    //  */
    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
    //         'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
    //         'photo' => ['nullable', 'image', 'max:2048'],
    //     ]);

    //     $user = Auth::user(); // Get the authenticated user

    //     // Update user details
    //     $user->name = $request->name;
    //     $user->email = $request->email;

    //     if ($request->filled('password')) {
    //         $user->password = Hash::make($request->password);
    //     }

    //     if ($request->hasFile('photo')) {
    //         // Handle photo upload and deletion of old photo if necessary
    //         // (Assuming you have a method to handle photo upload)
    //         $photoPath = $request->file('photo')->store('photos', 'public');
    //         // Optionally delete the old photo here
    //         $user->photo = $photoPath;
    //     }

    //     $user->save(); // Save the updated user

    //     return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    // }

    // /**
    //  * Delete the user account.
    //  */
    // public function destroy()
    // {
    //     $user = Auth::user(); // Get the authenticated user
    //     $user->delete(); // Delete the user

    //     return redirect()->route('home')->with('success', 'Account deleted successfully.');
    // }
}
