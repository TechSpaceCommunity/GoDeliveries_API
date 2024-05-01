<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\MajorCategory;
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
    public function editFood($id) {
        $restaurant = Auth::guard('restaurant')->user();
        
        // Find the food item by ID
        $food = Food::find($id);
        
        // Check if the food item exists and belongs to the authenticated restaurant
        if (!$food || $food->restaurant_id !== $restaurant->id) {
            // Handle the case where the food item does not exist or does not belong to the authenticated restaurant
            // You might want to redirect with an error message, for example:
            return redirect()->back()->with('error', 'Food item not found or not accessible');
        }
        
        // Get the categories
        $categories = Category::where('restaurant_id', $restaurant->id)->get();
        
        // Return the view with the data
        return view('restaurant.editfood', compact('restaurant', 'categories', 'food'));
    }
    

    public function category()  {
        $restaurant = Auth::guard('restaurant')->user();
        $majorcategories=MajorCategory::all();
        $categories=Category::where('restaurant_id', $restaurant->id)->get();
        return view('restaurant.category', compact('restaurant', 'categories', 'majorcategories'));
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
            'photo'=>'image|nullable|3072',
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
            'photo'=>'image|required|max:3072',
            'stock'=>"required|numeric",
            'child_cat_id'=>'required|exists:categories,id',
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
        
        $child_cat_id=$request->child_cat_id;
        $parent_cat_id=Category::find($child_cat_id);
        $data['parent_cat_id']=$parent_cat_id->parent_cat_id;

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

    public function updatefood(Request $request, $id)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'photo'=>'image|max:3072',
            'stock'=>"required|numeric",
            'child_cat_id'=>'required|exists:categories,id',
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
        
        $child_cat_id=$request->child_cat_id;
        $parent_cat_id=Category::find($child_cat_id);
        $data['parent_cat_id']=$parent_cat_id->parent_cat_id;

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
        /* else{
            $fileNameToStore='noImage.png';
        } */
        if ($request->hasFile('photo')) {
            $data['photo']=$fileNameToStore;
        }
        
        // return $data;
        $status=Food::find($id)->update($data);
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
