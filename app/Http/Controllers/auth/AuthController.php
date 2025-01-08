<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //



    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }



    public function register(){
        return view('auth.signup');
    }

    public function store(Request $request){
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
    public function loginWithFacebook(){
        $fb = new \Facebook\Facebook([
            'app_id' => '9374402789236571',
            'app_secret' => '0ad0d6e85e74cc642c28c168fed662e7',
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://localhost:8000/facebook/callback', $permissions);

        // Start the session
        if (!session_id()) {
            session_start();
        }

        return redirect()->to($loginUrl);
    }

    public function loginWithFacebookCallback(){
        $fb = new \Facebook\Facebook([
            'app_id' => '9374402789236571',
            'app_secret' => '0ad0d6e85e74cc642c28c168fed662e7',
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        // Start the session
        if (!session_id()) {
            session_start();
        }

        try {
            $accessToken = $helper->getAccessToken();
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            return response()->json(['error' => 'Graph returned an error: ' . $e->getMessage()], 500);
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            return response()->json(['error' => 'Facebook SDK returned an error: ' . $e->getMessage()], 500);
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                return response()->json([
                    'error' => $helper->getError(),
                    'error_code' => $helper->getErrorCode(),
                    'error_reason' => $helper->getErrorReason(),
                    'error_description' => $helper->getErrorDescription()
                ], 401);
            } else {
                return response()->json(['error' => 'Bad request'], 400);
            }
        }

        // Logged in
        try {
            $response = $fb->get('/me?fields=id,name,email', $accessToken);
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            return response()->json(['error' => 'Graph returned an error: ' . $e->getMessage()], 500);
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            return response()->json(['error' => 'Facebook SDK returned an error: ' . $e->getMessage()], 500);
        }

        $user = $response->getGraphUser();
        return response()->json(['name' => $user['name'], 'email' => $user['email']]);
    }


    //logout
    public function logout(){
        Auth::logout();
        return Redirect::route('home');
    }
}
