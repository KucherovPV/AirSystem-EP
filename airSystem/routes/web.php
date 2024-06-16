<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Auth::routes();
Route::post('/login', '\App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/register', '\App\Http\Controllers\Auth\RegisterController@register');

Route::get('/{page}', \App\Http\Controllers\IndexController::class)->where('page', '.*');
