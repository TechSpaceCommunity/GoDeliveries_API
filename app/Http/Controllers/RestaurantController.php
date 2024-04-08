<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class RestaurantController extends Controller
{
    //
    public function index()  {
        $restaurant = Auth::guard('restaurant')->user();
        $totalcategories=Category::where('restaurant_id', $restaurant->id)->count();
        $totalfood=Food::where('restaurant_id', $restaurant->id)->count();
        return view('restaurant.index', compact('restaurant', 'totalcategories', 'totalfood'));
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
        $categories=Category::where('restaurant_id', $restaurant->id)->get();
        $products=Food::where('restaurant_id', $restaurant->id)->get();
        return view('restaurant.food', compact('restaurant','categories', 'products'));
    }
    public function category()  {
        $restaurant = Auth::guard('restaurant')->user();
        $categories=Category::where('restaurant_id', $restaurant->id)->get();
        //$categories=Category::all();
        return view('restaurant.category', compact('restaurant', 'categories'));
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

    public function createcategory(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'photo'=>'image|nullable',
            'status'=>'required|in:active,inactive',
        ]);

        

        $data= $request->all();
        $slug=Str::slug($request->title);
        $count=Category::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        if ($request->hasFile('photo')) {
            # get file name with extension
            $filenameWithExt=$request->file('photo')->getClientOriginalName();
            //get file name
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get ext
            $extension=$request->file('photo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload the photo
            $path=$request->file('photo')->storeAs('public/category_photo/', $fileNameToStore);
        }
        else{
            $fileNameToStore='noImage.png';
        }
        $data['photo']=$fileNameToStore;
        //dd($data);
        $status=Category::create($data);
        if($status){
            request()->session()->flash('success','Category successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('category');
    }

    public function createfood(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'photo'=>'image|required',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'status'=>'required|in:active,inactive',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=Food::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        
        if ($request->hasFile('photo')) {
            # get file name with extension
            $filenameWithExt=$request->file('photo')->getClientOriginalName();
            //get file name
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get ext
            $extension=$request->file('photo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload the photo
            $path=$request->file('photo')->storeAs('public/food_photo/', $fileNameToStore);
        }
        else{
            $fileNameToStore='noImage.png';
        }
        $data['photo']=$fileNameToStore;
        // return $data;
        $status=Food::create($data);
        if($status){
            request()->session()->flash('success','Food Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('food');

    }
    /* delete operations */
    public function destroycategory($id)
    {
        $user=category::find($id);
        $user->delete();
        return redirect('category')->with('success', 'Category Deleted Successfully!!');
    }

    public function destroyfood($id)
    {
        $user=Food::find($id);
        $user->delete();
        return redirect('food')->with('success', 'Food Deleted Successfully!!');
    }
}
