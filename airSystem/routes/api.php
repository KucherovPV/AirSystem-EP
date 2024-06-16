<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('user/', [\App\Http\Controllers\Api\UserController::class, 'user']);
    Route::get('user/roles', [\App\Http\Controllers\Api\UserController::class, 'roles']);
});


Route::group(['middleware' => ['auth:sanctum', \App\Http\Middleware\AdminMiddleware::class], 'prefix' => 'admin'], function () {

    Route::resource('airlines', \App\Http\Controllers\Api\AirlineController::class)->only([
        'index', 'update', 'destroy', 'store'
    ]);
    Route::resource('airports', \App\Http\Controllers\Api\AirportController::class)->only([
        'index', 'update', 'destroy', 'store'
    ]);;
    Route::resource('boards', \App\Http\Controllers\Api\BoardController::class)->parameters([
        'board' => 'board_code'
    ])->only([
        'index', 'update', 'destroy', 'store'
    ]);
    Route::resource('cities', \App\Http\Controllers\Api\CityController::class)->parameters([
    ])->only([
        'index', 'update', 'destroy', 'store'
    ]);
    Route::resource('countries', \App\Http\Controllers\Api\CountryController::class)->parameters([
    ])->only([
        'index', 'update', 'destroy', 'store'
    ]);
    Route::resource('types', \App\Http\Controllers\Api\TypeCategoryController::class)->only([
        'show', 'update', 'destroy', 'store'
    ]);
    Route::resource('users', \App\Http\Controllers\Api\UserController::class);
    Route::resource('manufacturers', \App\Http\Controllers\Api\ManufacturerController::class)->only([
        'index', 'update', 'destroy', 'store'
    ]);
    Route::resource('models', \App\Http\Controllers\Api\AircraftModelController::class)->only([
        'index', 'update', 'destroy', 'store'
    ]);
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'operator'], function () {
    Route::post('/flights/import', [\App\Http\Controllers\Api\FlightController::class, 'import']);
    Route::resource('flights', \App\Http\Controllers\Api\FlightController::class)->only([
        'index', 'update', 'destroy', 'store'
    ]);
    Route::resource('airlines', \App\Http\Controllers\Api\AirlineController::class)->only([
        'index'
    ]);
    Route::resource('airports', \App\Http\Controllers\Api\AirportController::class)->only([
        'index'
    ]);
    Route::resource('boards', \App\Http\Controllers\Api\BoardController::class)->parameters([
        'board' => 'board_code'
    ])->only([
        'index'
    ]);
    Route::get('/boarding-takeoffs', [\App\Http\Controllers\Api\BoardingTakeoff\BoardingTakeoffController::class, 'show']);
    Route::resource('boarding-takeoffs', \App\Http\Controllers\Api\BoardingTakeoff\BoardingTakeoffController::class)->only([
        'update',
    ]);
    Route::get('/delays', [\App\Http\Controllers\Api\Delay\DelayController::class, 'show']);
    Route::resource('delays', \App\Http\Controllers\Api\Delay\DelayController::class)->only([
        'update',
    ]);
    Route::get('/schedules/export', [\App\Http\Controllers\Api\Schedule\ScheduleController::class, 'export']);
    Route::resource('schedules', \App\Http\Controllers\Api\Schedule\ScheduleController::class)->only([
        'index', 'update', 'destroy', 'store',
    ]);
    Route::get('/schedules', [\App\Http\Controllers\Api\Schedule\ScheduleController::class, 'show']);
    Route::resource('types', \App\Http\Controllers\Api\TypeCategoryController::class)->only([
        'show'
    ]);
    Route::resource('types', \App\Http\Controllers\Api\TypeCategoryController::class)->only([
        'show'
    ]);
    Route::resource('models', \App\Http\Controllers\Api\AircraftModelController::class)->only([
        'index'
    ]);
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'analyst'], function () {

    Route::get('/delays', [\App\Http\Controllers\Api\Delay\DelayController::class, 'getInfoForAnalyst']);
});
