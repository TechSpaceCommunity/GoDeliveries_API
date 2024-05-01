<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant; 
use App\Models\Rider;

class ApiController extends Controller
{
    public function getRestaurants()
    {
        $restaurants = Restaurant::where('status', '1')->get();

        return response()->json($restaurants);
    }

}
