<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/csrf-token', function (Request $request) {
    return response()->json(['csrfToken' => csrf_token()]);
});

Route::post('/auth/signup', [SignUpController::class, 'signUp']);
Route::post('/auth/signin', [LoginController::class, 'login']);

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);