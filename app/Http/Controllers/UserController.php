<?php

namespace App\Http\Controllers;

use App\Models\Role;
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




    public function index(Request $request)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }

        $users = User::with('roles')->get();
        $roles = Role::all();

        foreach ($users as $user) {
            if ($user->photo) {
                $user->photo = base64_encode($user->photo);
            }
        }

        return view('user.index', compact('users', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|array',
            'role.*' => 'exists:role,id',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageData = file_get_contents($file);
            $user->photo = $imageData;
        }

        $user->roles()->sync($validatedData['role']);
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }
    public function store(Request $request)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|array',
            'role.*' => 'exists:role,id',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageData = file_get_contents($file);
            $user->photo = $imageData;
        }
        $user->save();
        $user->roles()->attach($validatedData['role']);

        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }



    public function destroy($id)
    {
        if (!Gate::allows('isAdmin')) {
            abort(403);
        }

        $user = User::findOrFail($id);


        $user->roles()->detach();

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }

    // public function update(Request $request, $id)
    //     {
    //         if (!Gate::allows('isAdmin')) {
    //             abort(403);
    //         }
    //         $validatedData = $request->validate([
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users,email,' . $id,
    //             'password' => 'nullable|min:8',
    //             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //             'role' => 'required|in:admin,editor,user',
    //         ]);

    //         $user = User::findOrFail($id);
    //         $user->name = $validatedData['name'];
    //         $user->email = $validatedData['email'];

    //         if (!empty($validatedData['password'])) {
    //             $user->password = Hash::make($validatedData['password']);
    //         }
    //         $user->role = $validatedData['role'];
    //         if ($request->hasFile('photo')) {
    //             $file = $request->file('photo');
    //             $imageData = file_get_contents($file); 
    //             $user->photo = $imageData; 
    //         }


    //         $user->save();

    //         return redirect()->route('user.index')->with('success', 'User updated successfully!');
    //     }


    // public function store(Request $request)
    // {
    //     // Validate the input
    //     if (!Gate::allows('isAdmin')) {
    //         abort(403);
    //     }
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $id,
    //         'password' => 'nullable|min:8',
    //         'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //   'role' => 'nullable|array',
    //     ]);
    //     // Handle the file upload (if photo exists)
    //     if ($request->hasFile('photo')) {
    //         $filePath = $request->file('photo')->store('photos', 'public');
    //         $validated['photo'] = $filePath;
    //     }
    //     $user = User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make($validated['password']),
    //         'photo' => $photoPath,
    //     ]);
    //     // Hash the password
    //     $validated['password'] = Hash::make($validated['password']);

    //     // Create the user
    //     $user->role()->attach($validated['role']);
    //     $user->save();

    //     // Redirect back with a success message
    //     return redirect()->redirect()->route('user.store')->back()->with('success', 'User created successfully!');
    // }

}
