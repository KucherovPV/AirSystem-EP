<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get('user/', [App\Http\Controllers\UserController::class, 'user']);
    Route::get('user/role', [App\Http\Controllers\RoleController::class, 'userRole']);
});




Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function (){

    Route::get('airline/', [App\Http\Controllers\AirlineController::class, 'airline']);
    Route::post('airline/', [App\Http\Controllers\AirlineController::class, 'createAirline']);
    Route::patch('airline/{id}', [App\Http\Controllers\AirlineController::class, 'editAirline']);
    Route::delete('airline/{id}', [App\Http\Controllers\AirlineController::class, 'deleteAirline']);

    Route::get('airport/', [App\Http\Controllers\AirportController::class, 'airport']);
    Route::post('airport/', [App\Http\Controllers\AirportController::class, 'createAirport']);
    Route::patch('airport/{id}', [App\Http\Controllers\AirportController::class, 'editAirport']);
    Route::delete('airport/{id}', [App\Http\Controllers\AirportController::class, 'deleteAirport']);

    Route::get('board/', [App\Http\Controllers\BoardController::class, 'board']);
    Route::post('board/', [App\Http\Controllers\BoardController::class, 'createBoard']);
    Route::patch('board/{id}', [App\Http\Controllers\BoardController::class, 'editBoard']);
    Route::delete('board/{id}', [App\Http\Controllers\BoardController::class, 'deleteBoard']);

    Route::get('delay/',[App\Http\Controllers\DelayController::class, 'delay']);
    Route::post('delay/create/', [App\Http\Controllers\DelayController::class, 'createDelay']);


    Route::post('type/', [App\Http\Controllers\TypeCategoryController::class, 'createType']);
    Route::patch('type/{id}', [App\Http\Controllers\TypeCategoryController::class, 'editType']);
    Route::delete('type/{id}', [App\Http\Controllers\TypeCategoryController::class, 'deleteType']);
    Route::get('type/{category}/',[App\Http\Controllers\TypeCategoryController::class, 'typeByCategory']);

    Route::get('user/list/',[App\Http\Controllers\UserController::class, 'userList']);
    Route::get('user/{id}/',[App\Http\Controllers\UserController::class, 'userById']);

    Route::get('role/',[App\Http\Controllers\RoleController::class, 'role']);
    Route::post('role/create', [App\Http\Controllers\RoleController::class, 'createRole']);
    Route::get('role/delete/',[App\Http\Controllers\RoleController::class, 'deleteRole']);
});


