<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'token' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        if($user->remember_token !== $request->token){
            return back()->withErrors(['token' => 'Invalid token']);
        }

        $user->password = Hash::make($request->password);
        $user->remember_token = null;
        $user->save();

        return redirect('/login')->with('status', 'Password reset successful!');
    }
}
