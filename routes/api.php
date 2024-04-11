<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('/google', 'API\AuthController@redirectToGoogle');
    Route::get('/facebook', 'API\AuthController@redirectToFacebook');
});

