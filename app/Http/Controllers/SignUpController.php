<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SignUpController extends Controller
{
    public function signUp(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create a new user
        $user = new Customer();
        $user->name = $request->input('fullName');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->api_token = Str::random(60);

        $user->save();

        // Return success response
        return response()->json(['message' => 'User signed up successfully'], 201);
    }
}
