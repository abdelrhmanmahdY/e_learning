<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
class CheckRole
{ public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole($role)) {
            return redirect('/'); // Redirect to home or access denied page
        }

        return $next($request);
    }
}
