<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\LoginActivity;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Restaurant;
use App\Models\Rider;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function profileadmin()
    {
        return view('admin.profileadmin');
    }
    public function editprofile($id)
    {
        $user=User::find($id);
        return view('admin.editprofileadmin', compact('user'));
    }

    public function users()
    {
        $users=User::all();
        return view('admin.users')->with('users', $users);
    }

    public function customers()
    {
        $users=Customer::all();
        return view('admin.customers')->with('users', $users);
    }

    public function restaurants()
    {
        $users=Restaurant::all();
        return view('admin.restaurants')->with('users', $users);
    }

    public function restaurantsection()
    {
        $users=Customer::all();
        return view('admin.restaurantsection')->with('users', $users);
    }

    public function riders()
    {
        $users=Rider::all();
        return view('admin.riders')->with('users', $users);
    }

    public function notifications()
    {
        $users=Notification::all();
        return view('admin.notifications')->with('users', $users);
    }

    public function createcustomer(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'number' => ['required', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
         ]);
         
         
         $user= new Customer();
         $user->name=$request->input('name');
         $user->email=$request->input('email');
         $user->number=$request->input('number');
         $user->password=$request->input('password');
         $user->save();
         
         return redirect('customers')->with('success', 'Customer Added Successfully!!');
     }

     public function createrestaurant(Request $request)
     {
       
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'delivery_time' => ['required', 'string', 'max:255'],
            'minimum_order' => ['required'],
            'sales_tax' => ['required'],
            'cover_image' => 'image|max:3000|nullable',
            'password' => ['required', 'string', 'max:255'],
         ]);
         
         if ($request->hasFile('cover_image')) {
            # get file name with extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get file name
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get ext
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload the cover_image
            $path=$request->file('cover_image')->storeAs('public/restaurant_cover_images/', $fileNameToStore);
        }
        else{
            $fileNameToStore='noImage.png';
        }

         $user= new Restaurant();
         $user->name=$request->input('name');
         $user->username=$request->input('username');
         $user->address=$request->input('address');
         $user->delivery_time=$request->input('delivery_time');
         $user->minimum_order=$request->input('minimum_order');
         $user->sales_tax=$request->input('sales_tax');
         $user->cover_image=$fileNameToStore;
         $user->password=$request->input('password');
         $user->save();
         
         return redirect('restaurants')->with('success', 'Restaurant Added Successfully!!');
     }
     public function createrestaurantsection(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
         ]);
         
         
         $user= new Vendor();
         $user->email=$request->input('email');
         $user->password=$request->input('password');
         $user->restaurants=1;
         $user->save();
         
         return redirect('restaurantsection')->with('success', 'Restaurant Section Added Successfully!!');
     }
    
     public function createrider(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'number' => ['required', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'zone' => ['required', 'string', 'max:255'],
            'rider_image' => 'image|max:3000|nullable',
            'bike_image' => 'image|max:3000|nullable',
         ]);
         
         if ($request->hasFile('rider_image')) {
            # get file name with extension
            $filenameWithExt=$request->file('rider_image')->getClientOriginalName();
            //get file name
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get ext
            $extension=$request->file('rider_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload the rider_image
            $path=$request->file('rider_image')->storeAs('public/rider_images/', $fileNameToStore);
        }
        else{
            $fileNameToStore='noImage.png';
        }

        if ($request->hasFile('bike_image')) {
            # get file name with extension
            $filenameWithExt=$request->file('bike_image')->getClientOriginalName();
            //get file name
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get ext
            $extension=$request->file('bike_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStoreBike=$filename.'_'.time().'.'.$extension;
            //upload the bike_image
            $path=$request->file('bike_image')->storeAs('public/bike_images/', $fileNameToStoreBike);
        }
        else{
            $fileNameToStoreBike='noImage.png';
        }

         $user= new Rider();
         $user->name=$request->input('name');
         $user->username=$request->input('username');
         $user->number=$request->input('number');
         $user->password=$request->input('password');
         $user->zone=$request->input('zone');
         $user->rider_image=$fileNameToStore;
         $user->bike_image=$fileNameToStoreBike;
         $user->save();
         
         return redirect('riders')->with('success', 'Rider Added Successfully!!');
     }

     public function createuser(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'number' => ['required', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:admin,rider_manager,vendor_manager,restaurant_manager,customer_manager'],
         ]);
         
         
         $user= new User();
         $user->name=$request->input('name');
         $user->email=$request->input('email');
         $user->number=$request->input('number');
         $user->password=$request->input('password');
         $user->role=$request->input('role');
         $user->save();
         
         return redirect('users')->with('success', 'User Added Successfully!!');
     }

     /* notifications */
     public function createnotification(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
         ]);
         
         
         $user= new Notification();
         $user->title=$request->input('title');
         $user->body=$request->input('body');
         $user->save();
         
         return redirect('notifications')->with('success', 'Notification Added Successfully!!');
     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //update profile
 
     public function updateprofile(Request $request, $id)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
         ]);
         
         
         $user= User::find($id);
         $user->name=$request->input('name');
         $user->email=$request->input('email');
         //$user->access=Auth::user()->access;
         $user->password=Auth::user()->password;
         $user->save();
         
         return redirect('profileadmin')->with('success', 'Profile Updated Successfully!!');
     }
    
     public function activateuser($id)
    {
        $user=User::find($id);
        $user->update(['status' => 'active']); // Update the status to active
        return redirect('users')->with('success', 'User Activated Successfully!!');
    }

    public function destroyuser($id)
    {
        $user=User::find($id);
        $user->update(['status' => 'inactive']); // Update the status to inactive
        return redirect('users')->with('success', 'User Deactivated Successfully!!');
    }

    public function destroycustomer($id)
    {
        $user=Customer::find($id);
        $user->delete();
        return redirect('customers')->with('success', 'Customer Deleted Successfully!!');
    }
    
    public function destroynotification($id)
    {
        $user=notification::find($id);
        $user->delete();
        return redirect('notifications')->with('success', 'Notification Deleted Successfully!!');
    }
}
