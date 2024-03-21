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
use App\Models\User;
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
        //
       
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

    public function usersadmin()
    {
        //
        $users=User::all();
        $users=DB::select('SELECT * FROM users WHERE access="admin"');

        return view('admin.usersadmin')->with('users', $users);
    }

    public function userswholesalers()
    {
        //
        $users=User::all();
        $users=DB::select('SELECT * FROM users WHERE access="wholesaler"');

        return view('admin.userswholesalers')->with('users', $users);
    }

    public function usersretailers()
    {
        //
        $users=User::all();
        $users=DB::select('SELECT * FROM users WHERE access="retailer"');

        return view('admin.usersretailers')->with('users', $users);
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
    
    public function destroyuser($id)
    {
        //
        $user=User::find($id);
       
        $user->delete();
        return redirect('usersadmin')->with('success', 'User Deleted Successfully!!');
    }

    
    
}
