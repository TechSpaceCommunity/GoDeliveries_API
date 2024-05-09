<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/csrf-token', function (Request $request) {
    return response()->json(['csrfToken' => csrf_token()]);
}); 

/* Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login'); */

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
/* profile */
Route::get('/profileadmin', [AdminController::class, 'profileadmin'])->name('profileadmin');
Route::get('/editprofileadmin/{id}', [AdminController::class, 'editprofile'])->name('admin.editprofile');
Route::post('/editprofileadmin/{id}', [AdminController::class, 'updateprofile'])->name('admin.updateprofile');

/* riders */
Route::get('/riders', [AdminController::class, 'riders'])->name('riders');
Route::post('/riders', [AdminController::class, 'createrider'])->name('createrider');
Route::get('/editrider/{id}', [AdminController::class, 'editrider'])->name('editriders');
Route::post('/editrider/{id}', [AdminController::class, 'updaterider'])->name('editrider');
Route::delete('/rider/{id}', [AdminController::class, 'destroyrider'])->name('destroyrider');

/* app customers */
Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
Route::post('/customers', [AdminController::class, 'createcustomer'])->name('createcustomer');
Route::delete('/customers/{id}', [AdminController::class, 'destroycustomer'])->name('destroycustomer');

/* System users */
Route::get('/users', [AdminController::class, 'users'])->name('users');
Route::post('/users', [AdminController::class, 'createuser'])->name('createuser');
Route::get('/edituser/{id}', [AdminController::class, 'edituser'])->name('edituser');
Route::post('/edituser/{id}', [AdminController::class, 'updateuser'])->name('updateuser');
Route::delete('/users/{id}', [AdminController::class, 'destroyuser'])->name('destroyuser');
Route::put('/users/{id}', [AdminController::class, 'activateuser'])->name('activateuser');

/* restaurants */
Route::get('/adminrestaurants', [AdminController::class, 'restaurants'])->name('adminrestaurants');
Route::post('/adminrestaurants', [AdminController::class, 'createrestaurant'])->name('createrestaurant');
Route::get('/editadminrestaurants/{id}', [AdminController::class, 'editrestaurant'])->name('editadminrestaurants');
Route::post('/editadminrestaurants/{id}', [AdminController::class, 'updaterestaurant'])->name('editrestaurant');
Route::delete('/adminrestaurants/{id}', [AdminController::class, 'destroyrestaurant'])->name('destroyrestaurant');

/* restaurant sections */
Route::get('/restaurantsection', [AdminController::class, 'restaurantsection'])->name('restaurantsection');
Route::post('/restaurantsection', [AdminController::class, 'createrestaurantsection'])->name('createrestaurantsection');
Route::get('/editadminrestaurantsection/{id}', [AdminController::class, 'editrestaurantsection'])->name('editadminrestaurantsection');
Route::post('/editadminrestaurantsection/{id}', [AdminController::class, 'updaterestaurantsection'])->name('editrestaurantsection');
Route::delete('/adminrestaurantsection/{id}', [AdminController::class, 'destroyrestaurantsection'])->name('destroyrestaurantsection');

/* major food categories .. in the admin portal */
Route::get('/majorcategories', [AdminController::class, 'majorcategories'])->name('majorcategories');
Route::post('/majorcategory', [AdminController::class, 'createmajorcategory'])->name('createmajorcategory');
Route::get('/editmajorcategory/{id}', [AdminController::class, 'editmajorcategory'])->name('editadminmajorcategory');
Route::post('/editmajorcategory/{id}', [AdminController::class, 'updatemajorcategory'])->name('updatemajorcategory');
Route::delete('/majorcategories/{id}', [AdminController::class, 'destroymajorcategory'])->name('destroymajorcategory');

/* coupons */
Route::get('/coupons', [AdminController::class, 'coupons'])->name('coupons');
Route::post('/coupons', [AdminController::class, 'createcoupon'])->name('createcoupon');
Route::get('/editcoupon/{id}', [AdminController::class, 'editcoupon'])->name('editcoupons');
Route::post('/editcoupon/{id}', [AdminController::class, 'updatecoupon'])->name('updatecoupon');
Route::delete('/coupon/{id}', [AdminController::class, 'destroycoupon'])->name('destroycoupon');

/* notifications */
Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
Route::post('/notifications', [AdminController::class, 'createnotification'])->name('createnotification');
Route::delete('/notifications/{id}', [AdminController::class, 'destroynotification'])->name('destroynotification');

/* zones */
Route::get('/zones', [AdminController::class, 'zones'])->name('zones');
Route::post('/zones', [AdminController::class, 'createzone'])->name('createzone');
Route::get('/editzone/{id}', [AdminController::class, 'editzone'])->name('editzone');
Route::post('/editzone/{id}', [AdminController::class, 'updatezone'])->name('updatezone');
Route::delete('/zones/{id}', [AdminController::class, 'destroyzone'])->name('destroyzone');

/* dispatch */
Route::get('/admindispatch', [AdminController::class, 'admindispatch'])->name('admindispatch');

/* withdrawal requests */
Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('withdrawals');

/* commsion rates */
Route::get('/commissionrates', [AdminController::class, 'commissionrates'])->name('commissionrates');
Route::post('/commissionrates', [AdminController::class, 'createcommissionrate'])->name('createcommissionrate');
Route::get('/editcommissionrate/{id}', [AdminController::class, 'editcommissionrate'])->name('editcommissionrate');
Route::post('/editcommissionrate/{id}', [AdminController::class, 'updatecommissionrate'])->name('updatecommissionrate');
Route::delete('/commissionrates/{id}', [AdminController::class, 'destroycommissionrate'])->name('destroycommissionrate');

});

//Restaurant Routes
//Route::group(['middleware' => ['auth']], function(){
// restaurant dashboard
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants');

//login page
Route::get('/restaurantslogin', [RestaurantController::class, 'restaurantsloginform'])->name('restaurantsloginform');
Route::post('/restaurantslogin', [RestaurantController::class, 'authenticaterestaurantslogin'])->name('restaurantslogin');

//restaurant dashboard pages
//restaurant profile page
Route::get('/restaurantprofile', [RestaurantController::class, 'restaurantprofile'])->name('restaurantprofile');
Route::get('/editrestaurantprofile/{id}', [RestaurantController::class, 'editrestaurantprofile'])->name('editrestaurantprofile');
Route::post('/editrestaurantprofile/{id}', [RestaurantController::class, 'updaterestaurantprofile'])->name('updaterestaurantprofile');

// foods 
Route::get('/food', [RestaurantController::class, 'food'])->name('food');
Route::post('/food', [RestaurantController::class, 'createfood'])->name('createfood');
Route::get('/editfood/{id}', [RestaurantController::class, 'editfood'])->name('editfood');
Route::post('/editfood/{id}', [RestaurantController::class, 'updatefood'])->name('updatefood');
Route::delete('/food/{id}', [RestaurantController::class, 'destroyfood'])->name('food.destroy');

// child categories
Route::get('/category', [RestaurantController::class, 'category'])->name('category');
Route::post('/category', [RestaurantController::class, 'createcategory'])->name('createcategory');
Route::get('/editcategory/{id}', [RestaurantController::class, 'editcategory'])->name('editcategory');
Route::post('/editcategory/{id}', [RestaurantController::class, 'updatecategory'])->name('updatecategory');
Route::delete('/category/{id}', [RestaurantController::class, 'destroycategory'])->name('category.destroy');

//orders
Route::get('/orders', [RestaurantController::class, 'orders'])->name('orders');
Route::get('/orders/{id}', [RestaurantController::class, 'showorder'])->name('showorder');
Route::delete('/order/{id}', [RestaurantController::class, 'destroyorder'])->name('order.destroy');

/* ratings */
Route::get('/ratings', [RestaurantController::class, 'ratings'])->name('ratings');

/* food addons */
Route::get('/addons', [RestaurantController::class, 'addons'])->name('addons');
Route::post('/addons', [RestaurantController::class, 'createaddon'])->name('createaddon');
Route::get('/editaddon/{id}', [RestaurantController::class, 'editaddon'])->name('editaddon');
Route::post('/editaddon/{id}', [RestaurantController::class, 'updateaddon'])->name('updateaddon');
Route::delete('/addons/{id}', [RestaurantController::class, 'destroyaddon'])->name('addon.destroy');

/* restaurant payments */
Route::get('/payment', [RestaurantController::class, 'paymnent'])->name('payment');
Route::get('/payment/{id}', [RestaurantController::class, 'showpayment'])->name('showpayment');
Route::delete('/payment/{id}', [RestaurantController::class, 'destroypayment'])->name('payment.destroy');

Route::get('/dispatch', [RestaurantController::class, 'dispatch'])->name('dispatch');
//});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// API ENDPOINTS
Route::prefix('api')->group(function () {
    Route::post('/auth/signup', [SignUpController::class, 'signUp']);
    Route::post('/auth/signin', [LoginController::class, 'login']);

    Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
    Route::get('/auth/facebook', [LoginController::class, 'redirectToFacebook']);

    Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
    Route::get('/auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

    Route::post('/auth/rider/login', [LoginController::class, 'RiderLogin']);
    Route::post('/rideravailability', [LoginController::class, 'RiderAvailability']);

    Route::get('/getrestaurants', [ApiController::class, 'getRestaurants']);
    Route::get('/getcategories', [ApiController::class, 'getAllCategories']);
    Route::get('/getcategories/{restaurant_id}', [ApiController::class, 'getCategoriesByRestaurant']);
    Route::get('/getfoods', [ApiController::class, 'getAllFoods']);
});

Route::get('/redirect-to-app', function () {
    // Redirect to your React Native app
    return redirect()->away('exp://192.168.100.159:8081');
});

Route::get('/api/csrf-token', function (Request $request) {
    return response()->json(['csrfToken' => csrf_token()]);
});