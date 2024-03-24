<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Feedback;
use App\Models\LoginActivity;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\Order;
use App\Models\Payment;
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

    public function vendors()
    {
        $users=Vendor::all();
        return view('admin.vendors')->with('users', $users);
    }

    public function restaurants()
    {
        $users=Vendor::all();
        return view('admin.restaurants')->with('users', $users);
    }

    public function restaurantsection()
    {
        $users=Vendor::all();
        return view('admin.restaurantsection')->with('users', $users);
    }

    public function riders()
    {
        $users=Rider::all();
        return view('admin.riders')->with('users', $users);
    }

    public function createvendor(Request $request)
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
         
         return redirect('vendors')->with('success', 'Vendor Added Successfully!!');
     }

     public function createrestaurant(Request $request)
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
         ]);
         
         
         $user= new Rider();
         $user->name=$request->input('name');
         $user->username=$request->input('username');
         $user->number=$request->input('number');
         $user->password=$request->input('password');
         $user->zone=$request->input('zone');
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

    
    
}
