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

Route::get('/profileadmin', [AdminController::class, 'profileadmin'])->name('profileadmin');
Route::get('/editprofileadmin/{id}', [AdminController::class, 'editprofile'])->name('admin.editprofile');
Route::post('/editprofileadmin/{id}', [AdminController::class, 'updateprofile'])->name('admin.updateprofile');
Route::get('/usersadmin', [AdminController::class, 'usersadmin'])->name('usersadmin');
Route::get('/userswholesalers', [AdminController::class, 'userswholesalers'])->name('userswholesalers');
Route::get('/usersretailers', [AdminController::class, 'usersretailers'])->name('usersretailers');
});

Route::post('/auth/signup', [SignUpController::class, 'signUp']);
Route::post('/auth/signin', [LoginController::class, 'login']);

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
