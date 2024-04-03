<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    //
    public function index()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.index', compact('restaurant'));
    }

    public function restaurantsloginform()  {
        return view('restaurant.restaurantslogin');
    }

    public function authenticaterestaurantslogin(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // If validation fails, redirect back with validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        if (Auth::guard('restaurant')->attempt($credentials)) {
            // Authentication passed
            // Redirect to the restaurant's dashboard

            return redirect()->route('restaurants');
        }

        // Authentication failed, redirect back with an error message
        return redirect()->back()->with('error', 'Invalid credentials. Please try again.')->withInput();
    }

    //restaurant dashboard pages
    public function restaurantprofile()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.restaurantprofile', compact('restaurant'));
    }
    public function food()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.food', compact('restaurant'));
    }
    public function category()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.category', compact('restaurant'));
    }
    public function orders()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.orders', compact('restaurant'));
    }
    public function option()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.option', compact('restaurant'));
    }
    public function ratings()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.ratings', compact('restaurant'));
    }
    public function addons()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.addons', compact('restaurant'));
    }
    public function timings()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.timings', compact('restaurant'));
    }
    public function paymnent()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.paymnent', compact('restaurant'));
    }
    public function location()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.location', compact('restaurant'));
    }
    public function dispatch()  {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.dispatch', compact('restaurant'));
    }
}
