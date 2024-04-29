<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;

use App\Models\Restaurant;
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
/* users */
Route::get('/riders', [AdminController::class, 'riders'])->name('riders');
Route::post('/riders', [AdminController::class, 'createrider'])->name('createrider');
Route::get('/editrider/{id}', [AdminController::class, 'editrider'])->name('editriders');
Route::post('/editrider/{id}', [AdminController::class, 'updaterider'])->name('editrider');
Route::delete('/rider/{id}', [AdminController::class, 'destroyrider'])->name('destroyrider');
Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
Route::post('/customers', [AdminController::class, 'createcustomer'])->name('createcustomer');
Route::delete('/customers/{id}', [AdminController::class, 'destroycustomer'])->name('destroycustomer');
Route::get('/users', [AdminController::class, 'users'])->name('users');
Route::post('/users', [AdminController::class, 'createuser'])->name('createuser');
Route::delete('/users/{id}', [AdminController::class, 'destroyuser'])->name('destroyuser');
Route::put('/users/{id}', [AdminController::class, 'activateuser'])->name('activateuser');

Route::get('/adminrestaurants', [AdminController::class, 'restaurants'])->name('adminrestaurants');
Route::post('/adminrestaurants', [AdminController::class, 'createrestaurant'])->name('createrestaurant');
Route::get('/editadminrestaurants/{id}', [AdminController::class, 'editrestaurant'])->name('editadminrestaurants');
Route::post('/editadminrestaurants/{id}', [AdminController::class, 'updaterestaurant'])->name('editrestaurant');
Route::delete('/adminrestaurants/{id}', [AdminController::class, 'destroyrestaurant'])->name('destroyrestaurant');
Route::get('/restaurantsection', [AdminController::class, 'restaurantsection'])->name('restaurantsection');
Route::post('/restaurantsection', [AdminController::class, 'createrestaurantsection'])->name('createrestaurantsection');
Route::get('/editadminrestaurantsection/{id}', [AdminController::class, 'editrestaurantsection'])->name('editadminrestaurantsection');
Route::post('/editadminrestaurantsection/{id}', [AdminController::class, 'updaterestaurantsection'])->name('editrestaurantsection');
Route::delete('/adminrestaurantsection/{id}', [AdminController::class, 'destroyrestaurantsection'])->name('destroyrestaurantsection');
Route::get('/majorcategories', [AdminController::class, 'majorcategories'])->name('majorcategories');
Route::post('/majorcategory', [AdminController::class, 'createmajorcategory'])->name('createmajorcategory');
Route::get('/editmajorcategory/{id}', [AdminController::class, 'editmajorcategory'])->name('editadminmajorcategory');
Route::post('/editmajorcategory/{id}', [AdminController::class, 'updatemajorcategory'])->name('updatemajorcategory');
Route::delete('/majorcategories/{id}', [AdminController::class, 'destroymajorcategory'])->name('destroymajorcategory');
Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
Route::post('/notifications', [AdminController::class, 'createnotification'])->name('createnotification');
Route::delete('/notifications/{id}', [AdminController::class, 'destroynotification'])->name('destroynotification');
Route::get('/zones', [AdminController::class, 'zones'])->name('zones');
Route::post('/zones', [AdminController::class, 'createzone'])->name('createzone');
Route::get('/editzone/{id}', [AdminController::class, 'editzone'])->name('editzone');
Route::post('/editzone/{id}', [AdminController::class, 'updatezone'])->name('updatezone');
Route::delete('/zones/{id}', [AdminController::class, 'destroyzone'])->name('destroyzone');
});

//Restaurant Routes
//Route::group(['middleware' => ['auth']], function(){
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants');
Route::get('/restaurantslogin', [RestaurantController::class, 'restaurantsloginform'])->name('restaurantsloginform');
Route::post('/restaurantslogin', [RestaurantController::class, 'authenticaterestaurantslogin'])->name('restaurantslogin');
//restaurant dashboard pages
Route::get('/restaurantprofile', [RestaurantController::class, 'restaurantprofile'])->name('restaurantprofile');
Route::get('/food', [RestaurantController::class, 'food'])->name('food');
Route::post('/food', [RestaurantController::class, 'createfood'])->name('createfood');
Route::delete('/food/{id}', [RestaurantController::class, 'destroyfood'])->name('food.destroy');
Route::get('/category', [RestaurantController::class, 'category'])->name('category');
Route::post('/category', [RestaurantController::class, 'createcategory'])->name('createcategory');
Route::delete('/category/{id}', [RestaurantController::class, 'destroycategory'])->name('category.destroy');
Route::get('/orders', [RestaurantController::class, 'orders'])->name('orders');
Route::get('/option', [RestaurantController::class, 'option'])->name('option');
Route::get('/ratings', [RestaurantController::class, 'ratings'])->name('ratings');
Route::get('/addons', [RestaurantController::class, 'addons'])->name('addons');
Route::get('/timings', [RestaurantController::class, 'timings'])->name('timings');
Route::get('/paymnent', [RestaurantController::class, 'paymnent'])->name('paymnent');
Route::get('/location', [RestaurantController::class, 'location'])->name('location');
Route::get('/dispatch', [RestaurantController::class, 'dispatch'])->name('dispatch');
//});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// API ENDPOINTS
Route::prefix('api/auth')->group(function () {
    Route::post('/signup', [SignUpController::class, 'signUp']);
    Route::post('/signin', [LoginController::class, 'login']);

    Route::get('/google', [LoginController::class, 'redirectToGoogle']);
    Route::get('/facebook', [LoginController::class, 'redirectToFacebook']);

    Route::get('/google/callback', [LoginController::class, 'handleGoogleCallback']);
    Route::get('/facebook/callback', [LoginController::class, 'handleFacebookCallback']);
});

