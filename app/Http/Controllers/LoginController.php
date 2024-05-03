<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use App\Models\Rider;
use Illuminate\Support\Facades\Auth;;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


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
            $user->api_token = Str::random(60);
            $user->profile_pic = $socialiteUser->getAvatar();
            $user->save();
        }

        Log::info('User logged in successfully: ' . $user);
    
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = Customer::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json(['message' => 'Invalid credentials. Please try again.'], 401);
        }
    
        if (Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'User logged in successfully', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Invalid credentials. Please try again.'], 401);
        }
    }

    public function RiderLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = Rider::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json(['message' => 'Invalid credentials. Please try again.'], 401);
        }
        // check if $request->password and  $user->password match
        if ($user->password == $request->password) {
            // generate api_token and add it to user

            $user->api_token = Str::random(60);

            $user->save();
            return response()->json(['message' => 'User logged in successfully', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Invalid credentials. Please try again.'], 401);
        }
    }

    public function RiderAvailability(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:riders,id',
            'is_available' => 'required|boolean',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $user = Rider::find($request->user_id);
    
        if (!$user) {
            return response()->json(['message' => 'Rider not found.'], 404);
        }
    
        $status = $request->is_available ? 1 : 0;

        Log::info('Rider availability status: ' . $status);
    
        $user->status = $status;
        $user->save();
    
        return response()->json([
            'message' => 'Rider availability updated successfully.',
            'user' => $user 
        ], 200);
    }    

    
}