<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleGoogleCallback()
    {
        $socialiteUser = Socialite::driver('google')->stateless()->user();
    
        // Check if the user exists in the database
        $user = Customer::where('email', $socialiteUser->getEmail())->first();
    
        if (!$user) {
            // User does not exist, create a new user
            $user = new Customer();
            $user->name = $socialiteUser->getName();
            $user->email = $socialiteUser->getEmail();
            $user->password = bcrypt($socialiteUser->getName()); 
            $user->save();
        }
    
         return view('login_success')->with([
            'user' => $user,
        ]);
    }
    

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleFacebookCallback()
    {
        $socialiteUser = Socialite::driver('facebook')->stateless()->user();

        // Check if the user exists in the database
        $user = Customer::where('email', $socialiteUser->getEmail())->first();

        if (!$user) {
            // User does not exist, create a new user with Facebook email
            $user = new Customer();
            $user->name = $socialiteUser->getName() ?? 'Facebook User';
            $user->email = $socialiteUser->getEmail();
            $user->save();
        }

        // Return user details
        return view('login_success')->with([
            'user' => $user,
        ]);
    }

    public function login(Request $request)
    {
        // Validate user input
        Log::info('Email: ' . $request->email);
        Log::info('Password: ' . $request->password);
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        

        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Authentication successful
            $user = Auth::user();
            // Generate a new API token for the user if one doesn't already exist
            if (empty($user->api_token)) {
                $user->api_token = Str::random(60);
                $user->save();
            }
            return response()->json(['message' => 'User logged in successfully', 'user' => $user]);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}