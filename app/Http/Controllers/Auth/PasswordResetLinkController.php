<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {

        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the email input
        $request->validate(['email' => 'required|email']);

        // Send the reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Redirect to the reset password page if the link was sent
        if ($status == Password::RESET_LINK_SENT) {
            // Find the user and create a token
            $user = User::where('email', $request->email)->first();
            $token = Password::createToken($user);

            // Redirect to the reset password form with the token
            return redirect()->route('password.reset', ['token' => $token, 'email' => $request->email]);
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
