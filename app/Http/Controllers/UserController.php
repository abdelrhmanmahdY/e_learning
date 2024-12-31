<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Penalty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;


use Illuminate\Routing\Controller as BaseController;

use App\Http\Middleware\CheckUserRole; // Import the middleware



class UserController extends Controller

{





    public function index(Request $request)
    {
        if (!Gate::allows('isAdmin')) {
            abort(404);
        }

        $users = User::with('roles')->get();
        $penalties  = Penalty::all();
        $roles = Role::all();

        foreach ($users as $user) {
            if ($user->photo) {
                $user->photo = base64_encode($user->photo);
            }
        }

        return view('user.index', compact('users', 'roles', 'penalties'));
    }


    public function update(Request $request, $id)
    {     if (!Gate::allows('isAdmin')) {
        abort(404);
    }
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
            abort(404);
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
            abort(404);
        }
        $user = User::findOrFail($id);
        if (Auth::check() && Auth::user()->getAuthIdentifier() == $user['id']) {
            return redirect()->back()->with('error', 'You cannot delete yourself!');
        } else {

            $user->roles()->detach();
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully!');
        }
    }


    public function addPenalty(Request $request, $id)
    {
        if (!Gate::allows('isAdmin')) {
            abort(404);
        }

        $validatedData = $request->validate([
            'penalty_id' => 'required|exists:penalties,id',
        ]);

        $user = User::findOrFail($id);
        if ($user->hasPenalty($validatedData['penalty_id'])) {
            return redirect()->back()->with('error', 'student already have Penalty.');
        }
        if (!$user->roles->contains('role_name', 'student')) {
            return redirect()->back()->with('error', 'Only students can be assigned penalties.');
        }
        // Assign penalty
        $user->save();
        $user->penalties()->attach($validatedData['penalty_id']);
        $penalties = Penalty::findOrFail($validatedData['penalty_id']);
        if($penalties->severity_level){
      $penalties->duration=Carbon::now()->addDays(7);}
else{$penalties->duration=Carbon::now()->addDays(15);}
      $penalties->save();
        return redirect()->back()->with('success', 'Penalty added to the student successfully!');
    }

    
    public function destroyPenalty($id, Request $request)
    {
        if (!Gate::allows('isAdmin')) {
            abort(404);
        }
        $user = User::findOrFail($id);
    
        if (Auth::check() && Auth::user()->getAuthIdentifier() == $user->id) {
            return redirect()->back()->with('error', 'You cannot delete yourself!');
        } else {
            // Retrieve selected penalty IDs from the request
            $penaltyIds = $request->input('penalty_ids', []);
            
            // Detach the selected penalties from the user
            $user->penalties()->detach($penaltyIds);
            
            return redirect()->route('user.index')->with('success', 'Selected penalties deleted successfully!');
        }
    }
    
}
