<?php

namespace App\Http\Controllers;

use App\Models\CommissionRate;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Dispatch;
use App\Models\MajorCategory;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantSection;
use App\Models\Rider;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalcustomers=Customer::all()->count();
        
        return view('home', compact('totalcustomers'));
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
    public function edituser($id)
    {
        $user=User::find($id);
        return view('admin.edituser', compact('user'));
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
    public function editrestaurant($id)
    {
        $restaurant=Restaurant::find($id);
        return view('admin.editadminrestaurants', compact('restaurant'));
    }
    
    public function restaurantsection()
    {
        $restaurantsections=restaurantsection::all();
        $restaurants=Restaurant::all();
        return view('admin.restaurantsection', compact('restaurantsections', 'restaurants'));
    }
    public function editrestaurantsection($id)
    {
        $restaurantsection = RestaurantSection::find($id);
        $restaurants = Restaurant::all();
        
        // Retrieve the existing restaurants data associated with the restaurant section
        $existingRestaurantsData = json_decode($restaurantsection->restaurants, true);
        
        // Extract only the IDs from the existing restaurants data
        $existingRestaurantIds = array_map(function ($restaurant) {
            return $restaurant['id'];
        }, $existingRestaurantsData);
        
        return view('admin.editrestaurantsection', compact('restaurantsection', 'restaurants', 'existingRestaurantIds'));
        
    }

    public function riders()
    {
        $users=Rider::all();
        $zones=Zone::all();
        return view('admin.riders', compact('users', 'zones'));
    }
    public function editrider($id)
    {
        $rider=Rider::find($id);
        $zones=Zone::all();
        return view('admin.editrider', compact('rider', 'zones'));
    }

    public function majorcategories()
    {
        $categories=MajorCategory::all();
        return view('admin.majorcategories')->with('categories', $categories);
    }
    public function editmajorcategory($id)
    {
        $category=majorcategory::find($id);
        return view('admin.editmajorcategory', compact('category'));
    }

    public function coupons()
    {
        $coupons=Coupon::all();
        return view('admin.coupons')->with('coupons', $coupons);
    }
    public function editcoupon($id)
    {
        $coupon=coupon::find($id);
        return view('admin.editcoupon', compact('coupon'));
    }

    public function notifications()
    {
        $users=Notification::all();
        return view('admin.notifications')->with('users', $users);
    }

    public function zones()
    {
        $users=Zone::all();
        return view('admin.zones')->with('users', $users);
    }
    public function editzone($id)
    {
        $zone=Zone::find($id);
        return view('admin.editzone', compact('zone'));
    }

    public function admindispatch()
    {
        $dispatches=Dispatch::all();
        $orders=Order::all();
        $riders=Rider::all();
        return view('admin.admindispatch', compact('dispatches', 'orders', 'riders'));
    }

    public function withdrawals()
    {
        $withdrawals=Withdrawal::all();
        $riders=Rider::all();
        return view('admin.withdrawals', compact('withdrawals', 'riders'));
    }

    public function commissionrates()
    {
        $commissionrates=CommissionRate::all();
        $riders=Rider::all();
        return view('admin.commissionrates', compact('commissionrates', 'riders'));
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
            'email' => ['required', 'email', 'unique:restaurants'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'opening_time' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
            'minimum_order' => ['required'],
            'closing_time' => ['required'],
            'cover_image' => 'image|max:3072|nullable',
            'password' => ['required', 'string', 'max:255'],
         ]);
         
         //cover image
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

         // Hash the password
        $hashedPassword = Hash::make($request->input('password'));
         $user= new Restaurant();
         $user->name=$request->input('name');
         $user->email=$request->input('email');
         $user->address=$request->input('address');
         $user->description=$request->input('description');
         $user->status=$request->input('status');
         $user->opening_time=$request->input('opening_time');
         $user->minimum_order=$request->input('minimum_order');
         $user->closing_time=$request->input('closing_time');
         $user->cover_image=$fileNameToStore;
         $user->password=$hashedPassword;
         $user->save();
         
         return redirect('adminrestaurants')->with('success', 'Restaurant Added Successfully!!');
     }
     public function createrestaurantsection(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
            'restaurants'=>'required'
         ]);
         
         //dd($request->input('status'));
         $restaurantsection= new RestaurantSection();
         $restaurantsection->name=$request->input('name');
         $restaurantsection->status =$request->input('status');
         // Initialize an array to hold the selected restaurant data
        $selectedRestaurantData = [];

        // Process selected restaurants
        if ($request->has('restaurants')) {
            $selectedRestaurants = $request->input('restaurants');
            foreach ($selectedRestaurants as $restaurantId => $data) {
                if (isset($data['selected'])) {
                    // Add the selected restaurant data to the array
                    $selectedRestaurantData[] = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'address' => $data['address'],
                    ];
                }
            }
        }

         // Save the JSON-encoded restaurant data to the restaurants column
        $restaurantsection->restaurants = json_encode($selectedRestaurantData);

         $restaurantsection->save();
         
         return redirect('restaurantsection')->with('success', 'Restaurant Section Added Successfully!!');
     }
    
     public function createrider(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:riders'],
            'number' => ['required', 'max:15'],
            'id_number' => ['required','min:8', 'max:8'],
            'password' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
            'zone' => ['required', 'max:255'],
            'rider_image' => 'image|max:3072|nullable',
            'bike_image' => 'image|max:3072|nullable',
            'id_image' => 'image|max:3072|nullable',
         ]);
         
         //rider profile image
         if ($request->hasFile('rider_image')) {
            $filenameWithExt=$request->file('rider_image')->getClientOriginalName();
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension=$request->file('rider_image')->getClientOriginalExtension();

            $fileNameToStore=$filename.'_'.time().'.'.$extension;

            $path=$request->file('rider_image')->storeAs('public/rider_images/', $fileNameToStore);
        }
        else{
            $fileNameToStore='noImage.png';
        }

        //rider's bike image
        if ($request->hasFile('bike_image')) {

            $filenameWithExt=$request->file('bike_image')->getClientOriginalName();

            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension=$request->file('bike_image')->getClientOriginalExtension();

            $fileNameToStoreBike=$filename.'_'.time().'.'.$extension;

            $path=$request->file('bike_image')->storeAs('public/bike_images/', $fileNameToStoreBike);
        }
        else{
            $fileNameToStoreBike='noImage.png';
        }

        //rider's nation ID image
        if ($request->hasFile('id_image')) {

            $filenameWithExt=$request->file('id_image')->getClientOriginalName();

            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension=$request->file('id_image')->getClientOriginalExtension();

            $fileNameToStoreID=$filename.'_'.time().'.'.$extension;

            $path=$request->file('id_image')->storeAs('public/id_images/', $fileNameToStoreID);
        }
        else{
            $fileNameToStoreID='noImage.png';
        }


         $user= new Rider();
         $user->name=$request->input('name');
         $user->email=$request->input('email');
         $user->number=$request->input('number');
         $user->id_number=$request->input('id_number');
         $user->password=$request->input('password');
         $user->zone=$request->input('zone');
         $user->status =$request->input('status');
         $user->rider_image=$fileNameToStore;
         $user->bike_image=$fileNameToStoreBike;
         $user->id_image=$fileNameToStoreID;
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

     // major food categories

     public function createmajorcategory(Request $request)
        {
            // return $request->all();
            $this->validate($request,[
                'title'=>'string|required',
                'summary'=>'string|nullable',
                'photo'=>'image|nullable|max:3072',
                'status'=>'required|in:active,inactive',
            ]);

            $data= $request->all();
            $slug=Str::slug($request->title);
            $count=MajorCategory::where('slug',$slug)->count();
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
                $path=$request->file('photo')->storeAs('public/majorcategory_photo/', $fileNameToStore);
            }
            else{
                $fileNameToStore='noImage.png';
            }
            $data['photo']=$fileNameToStore;
            //dd($data);
            $status=MajorCategory::create($data);
            if($status){
                request()->session()->flash('success','Major Food Category successfully added');
            }
            else{
                request()->session()->flash('error','Error occurred, Please try again!');
            }
            return redirect()->route('majorcategories');
        }

        /* coupons */
     public function createcoupon(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'code' => ['required', 'string', 'max:255' ,'unique:coupons'],
            'value' => ['required'],
            'status'=>'required|in:0,1',
            'type'=>'required|in:fixed,percent',
         ]);
         
         
         $user= new coupon();
         $user->code=$request->input('code');
         $user->type=$request->input('type');
         $user->value=$request->input('value');
         $user->status=$request->input('status');
         $user->save();
         
         return redirect('coupons')->with('success', 'Coupon Added Successfully!!');
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

     /* zones */
     public function createzone(Request $request)
     {
         //validation for the required fields
         $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cordinates' => ['required', 'string'],
         ]);
         
         
         $user= new zone();
         $user->title=$request->input('title');
         $user->description=$request->input('description');
         $user->cordinates=$request->input('cordinates');
         $user->save();
         
         return redirect('zones')->with('success', 'Zone Added Successfully!!');
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
    
     // updates for features
     public function updaterestaurant(Request $request, $id)
     {
       
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            /* 'email' => ['required', 'email', 'unique:restaurants'], */
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'opening_time' => ['required', 'string', 'max:255'],
            'minimum_order' => ['required'],
            'status' => ['required', 'in:0,1'],
            'closing_time' => ['required'],
            'cover_image' => 'image|max:3000|nullable',
            'password' => [ 'string', 'max:255', 'nullable'],
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
        /* else{
            $fileNameToStore='noImage.png';
        } */

         // Hash the password
        $hashedPassword = Hash::make($request->input('password'));
         $user= Restaurant::find($id);
         $user->name=$request->input('name');
         $user->email=$request->input('email');
         $user->address=$request->input('address');
         $user->description=$request->input('description');
         $user->status=$request->input('status');
         $user->opening_time=$request->input('opening_time');
         $user->minimum_order=$request->input('minimum_order');
         $user->closing_time=$request->input('closing_time');
         if ($request->hasFile('cover_image')) {
            $user->cover_image= $fileNameToStore;
        }
         $user->password=$hashedPassword;
         $user->save();
         
         return redirect('adminrestaurants')->with('success', 'Restaurant Updated Successfully!!');
     }

     public function updaterestaurantsection(Request $request, $id)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
            'restaurants'=>'required'
         ]);
         
         //dd($request->input('status'));
         $restaurantsection=RestaurantSection::find($id);
         $restaurantsection->name=$request->input('name');
         $restaurantsection->status =$request->input('status');
         // Initialize an array to hold the selected restaurant data
        $selectedRestaurantData = [];

        // Process selected restaurants
        if ($request->has('restaurants')) {
            $selectedRestaurants = $request->input('restaurants');
            foreach ($selectedRestaurants as $restaurantId => $data) {
                if (isset($data['selected'])) {
                    // Add the selected restaurant data to the array
                    $selectedRestaurantData[] = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'address' => $data['address'],
                    ];
                }
            }
        }

         // Save the JSON-encoded restaurant data to the restaurants column
        $restaurantsection->restaurants = json_encode($selectedRestaurantData);

        $restaurantsection->save();
         
         return redirect('restaurantsection')->with('success', 'Restaurant Section Updated Successfully!!');
     }

     /* update user */
     public function updateuser(Request $request, $id)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'max:255'],
            'role' => ['required', 'in:admin,rider_manager,vendor_manager,restaurant_manager,customer_manager'],
         ]);
         
         
         $user= User::find($id);
         $user->name=$request->input('name');
         $user->email=$request->input('email');
         $user->number=$request->input('number');
         $user->role=$request->input('role');
         $user->save();
         
         return redirect('users')->with('success', 'User Updated Successfully!!');
     }
     public function updaterider(Request $request, $id)
     {
         //validation for the required fields
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            /* 'email' => ['required', 'email', 'unique:riders'], */
            'number' => ['required', 'max:15'],
            'id_number' => ['required', 'max:8', 'min:8'],
            'password' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:0,1'],
            'zone' => ['required', 'max:255'],
            'rider_image' => 'image|max:3072|nullable',
            'bike_image' => 'image|max:3072|nullable',
            'id_image' => 'image|max:3072|nullable'
         ]);
         
         //rider profile image
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
        /* else{
            $fileNameToStore='noImage.png';
        } */

        // ride number plate image
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
        /* else{
            $fileNameToStoreBike='noImage.png';
        } */

        // ride national id image
        if ($request->hasFile('id_image')) {
            # get file name with extension
            $filenameWithExt=$request->file('id_image')->getClientOriginalName();
            //get file name
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get ext
            $extension=$request->file('id_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStoreID=$filename.'_'.time().'.'.$extension;
            //upload the id_image
            $path=$request->file('id_image')->storeAs('public/id_images/', $fileNameToStoreID);
        }
        /* else{
            $fileNameToStoreID='noImage.png';
        } */

         $user= Rider::find($id);
         $user->name=$request->input('name');
         $user->email=$request->input('email');
         $user->number=$request->input('number');
         $user->id_number=$request->input('id_number');
         $user->password=$request->input('password');
         $user->zone=$request->input('zone');
         $user->status =$request->input('status');
         if ($request->hasFile('rider_image')) {
            $user->rider_image= $fileNameToStore;
        }
        if ($request->hasFile('bike_image')) {
            $user->bike_image= $fileNameToStoreBike;
        }
        if ($request->hasFile('id_image')) {
            $user->id_image= $fileNameToStoreID;
        }
         $user->save();
         
         return redirect('riders')->with('success', 'Rider Updated Successfully!!');
     }

     public function updatemajorcategory(Request $request, $id)
        {
            // return $request->all();
            $this->validate($request,[
                'title'=>'string|required',
                'summary'=>'string|nullable',
                'photo'=>'image|nullable|max:3072',
                'status'=>'required|in:active,inactive',
            ]);

            

            $data= $request->all();
            $slug=Str::slug($request->title);
            $count=MajorCategory::where('slug',$slug)->count();
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
                $path=$request->file('photo')->storeAs('public/majorcategory_photo/', $fileNameToStore);
            }
            else{
                $fileNameToStore='noImage.png';
            }
            $data['photo']=$fileNameToStore;
            //dd($data);
            $status=MajorCategory::find($id)->update($data);
            if($status){
                request()->session()->flash('success','Major Food Category successfully updated');
            }
            else{
                request()->session()->flash('error','Error occurred, Please try again!');
            }
            return redirect()->route('majorcategories');
        }

        /* update coupons */
     public function updatecoupon(Request $request, $id)
     {
         //validation for the required fields
         $this->validate($request, [
            'value' => ['required'],
            'status'=>'required|in:0,1',
            'type'=>'required|in:fixed,percent',
         ]);
         
         
         $user=coupon::find($id);
         $user->code=$request->input('code');
         $user->type=$request->input('type');
         $user->value=$request->input('value');
         $user->status=$request->input('status');
         $user->save();
         
         return redirect('coupons')->with('success', 'Coupon Updated Successfully!!');
     }

     public function updatezone(Request $request, $id)
     {
         //validation for the required fields
         $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cordinates' => ['required', 'string'],
         ]);
         
         
         $user= zone::find($id);
         $user->title=$request->input('title');
         $user->description=$request->input('description');
         $user->cordinates=$request->input('cordinates');
         $user->save();
         
         return redirect('zones')->with('success', 'Zone Updated Successfully!!');
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

    public function destroyrider($id)
    {
        $user=Rider::find($id);
        /* $user->update(['status' => 0]); */ // Update the status to inactive
        $user->delete();
        return redirect('riders')->with('success', 'Rider Deleted Successfully!!');
    }

    public function destroycustomer($id)
    {
        $user=Customer::find($id);
        $user->delete();
        return redirect('customers')->with('success', 'Customer Deleted Successfully!!');
    }

    public function destroyrestaurant($id)
    {
        $user=restaurant::find($id);
        $user->delete();
        return redirect('adminrestaurants')->with('success', 'Restaurant Deleted Successfully!!');
    }
    
    public function destroyrestaurantsection($id)
    {
        $user=restaurantsection::find($id);
        $user->delete();
        return redirect('restaurantsection')->with('success', 'Restaurant Section Deleted Successfully!!');
    }

    public function destroymajorcategory($id)
    {
        $user=majorcategory::find($id);
        $user->delete();
        return redirect('majorcategories')->with('success', 'Major food category Deleted Successfully!!');
    }
    
    public function destroynotification($id)
    {
        $user=notification::find($id);
        $user->delete();
        return redirect('notifications')->with('success', 'Notification Deleted Successfully!!');
    }

    public function destroyzone($id)
    {
        $user=zone::find($id);
        $user->delete();
        return redirect('zones')->with('success', 'Zone Deleted Successfully!!');
    }
}
