<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,',
            'password' => 'nullable|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);


        $user = new User();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageData = file_get_contents($file);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo' => $imageData,

            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),


            ]);
        }
        $studentRole = Role::where('role_name', 'student')->first();
        $user->roles()->attach($studentRole);
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
