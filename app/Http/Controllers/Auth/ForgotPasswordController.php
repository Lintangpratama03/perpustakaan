<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function create()
    {
        return view('auth.passrecover.forgot-password');
    }

    public function store(Request $request)
    {
        if (config('app.is_demo')) {
            return back()->with('error', "You are in a demo version, resetting password is disabled.");
        }

        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this User. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the User. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
