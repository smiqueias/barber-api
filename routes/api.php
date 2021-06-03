<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function (){
    Route::apiResource('/companies', \App\Http\Controllers\CompanyController::class);
    Route::apiResource('/employees', \App\Http\Controllers\EmployeeController::class);
    Route::apiResource('/services', \App\Http\Controllers\ServiceController::class);
    Route::apiResource('/schedules', \App\Http\Controllers\ScheduleController::class);
});
