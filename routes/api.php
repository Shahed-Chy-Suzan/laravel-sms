<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;

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


Route::prefix('v1')->group(function(){
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/forgot',[ForgotPasswordController::class,'forgotPassword']);

    Route::get('/login',function(){   //middleware('auth:api') mane authenticated route na pele ei route e eshe auto hit krbe
        return response()->json([
            'message' => 'Unauthenticated',
        ],401);
    })->name('login');

    Route::middleware('auth:api')->group(function(){             //ekhane ei route gula access korte Login thaka lagbe.
        Route::post('/logout',[AuthController::class,'logout']);
    });
});
