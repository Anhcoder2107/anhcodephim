<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    //



    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }



    public function register()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('');
    }

    //login with facebook
    public function loginWithFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            // dd($user);
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'facebook_id' => $user->id,
                ]);

                Auth::login($newUser);
                return redirect()->intended('');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    //login with google
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            // dd($user);
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'google_id' => $user->id,
                ]);

                Auth::login($newUser);
                return redirect()->intended('');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }





    //logout
    public function logout()
    {
        Auth::logout();
        return Redirect::route('home');
    }
}
