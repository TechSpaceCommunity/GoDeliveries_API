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

    public function getCategoriesByRestaurant($id)
    {
        try {
            $categories = Category::where('restaurant_id', $id)->get();
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch categories'], 500);
        }
    }

    // getFoodsByCategory
    public function getFoodsByCategory($id)
    {
        try{
            $foods = Food::where('child_cat_id', $id)->get();
            return response()->json($foods);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to fetch foods'], 500);
        }
    }

    public function getAllFoods()
    {
        $categories = Food::all();

        return response()->json($categories);
    }

}
