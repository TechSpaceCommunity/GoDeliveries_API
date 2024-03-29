<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
/* profile */
Route::get('/profileadmin', [AdminController::class, 'profileadmin'])->name('profileadmin');
Route::get('/editprofileadmin/{id}', [AdminController::class, 'editprofile'])->name('admin.editprofile');
Route::post('/editprofileadmin/{id}', [AdminController::class, 'updateprofile'])->name('admin.updateprofile');
/* users */
Route::get('/riders', [AdminController::class, 'riders'])->name('riders');
Route::post('/riders', [AdminController::class, 'createrider'])->name('createrider');
Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
Route::post('/customers', [AdminController::class, 'createcustomer'])->name('createcustomer');
Route::delete('/customers/{id}', [AdminController::class, 'destroycustomer'])->name('destroycustomer');
Route::get('/users', [AdminController::class, 'users'])->name('users');
Route::post('/users', [AdminController::class, 'createuser'])->name('createuser');
Route::delete('/users/{id}', [AdminController::class, 'destroyuser'])->name('destroyuser');
Route::put('/users/{id}', [AdminController::class, 'activateuser'])->name('activateuser');

Route::get('/restaurants', [AdminController::class, 'restaurants'])->name('restaurants');
Route::post('/restaurants', [AdminController::class, 'createrestaurant'])->name('createrestaurant');
Route::delete('/restaurants/{id}', [AdminController::class, 'destroyrestaurant'])->name('destroyrestaurant');
Route::get('/restaurantsection', [AdminController::class, 'restaurantsection'])->name('restaurantsection');
Route::post('/restaurantsection', [AdminController::class, 'createrestaurantsection'])->name('createrestaurantsection');
Route::get('/configuration', [AdminController::class, 'configuration'])->name('configuration');
Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
Route::post('/notifications', [AdminController::class, 'createnotification'])->name('createnotification');
Route::delete('/notifications/{id}', [AdminController::class, 'destroynotification'])->name('destroynotification');
Route::get('/zones', [AdminController::class, 'zones'])->name('zones');
Route::post('/zones', [AdminController::class, 'createzone'])->name('createzone');
Route::delete('/zones/{id}', [AdminController::class, 'destroyzone'])->name('destroyzone');
});

Route::post('/auth/signup', [SignUpController::class, 'signUp']);
Route::post('/auth/signin', [LoginController::class, 'login']);

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
