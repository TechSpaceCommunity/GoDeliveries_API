<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant; 
use App\Models\Rider;
use App\Models\Category;
use App\Models\Food;

class ApiController extends Controller
{
    public function getRestaurants()
    {
        $restaurants = Restaurant::where('status', '1')->get();

        return response()->json($restaurants);
    }

    public function getAllCategories()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function getAllFoods()
    {
        $categories = Food::all();

        return response()->json($categories);
    }

}
