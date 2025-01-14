<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{


    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }
        $token = bin2hex(random_bytes(32));

        $user->remember_token = $token;
        $user->save();

        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

        Mail::send('auth.emails.password-reset', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });

        return back()->with('status', 'We have emailed your password reset link!');
    }
}

