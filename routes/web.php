<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TriviaController;

$controller_prefix = 'App\Http\Controllers\\';

// This is where you want to define your path
// and put appropriate middleware to protect your route
// we want to prevent unauthenticated user to go to "/" route
// if you have more time
// create a middleware to prevent authenticated user from "/login" and "/register"

Route::group(['middleware' => ['auth.redirect']], function () use ($controller_prefix) {
    Route::get('/login', $controller_prefix.'AuthController@login');
    Route::get('/register', $controller_prefix.'AuthController@register');
});

Route::post('/login', $controller_prefix.'AuthController@authenticate')->name('login');
Route::post('/register', $controller_prefix.'AuthController@register')->name('register');
Route::post('/logout', $controller_prefix.'AuthController@logout')->name('logout');

Route::get('/', [TriviaController::class, 'index'])->middleware('auth');
