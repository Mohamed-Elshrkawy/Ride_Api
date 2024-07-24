<?php

use App\Http\Controllers\Api\UserApp\App\ProfileUserController;
use App\Http\Controllers\Api\UserApp\App\RideController;
use App\Http\Controllers\Api\UserApp\App\UserLocationController;
use App\Http\Controllers\Api\UserApp\Auth\LoginController;
use App\Http\Controllers\Api\UserApp\Auth\RegisterController;
use App\Http\Controllers\Api\UserApp\Auth\ResetPasswordController;
use App\Http\Controllers\Api\UserApp\Auth\VerifiyEmailController;
use App\Http\Controllers\Api\UserApp\Auth\VerifiyPhoneController;
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
Route::group(['prefix' => 'auth'],function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('send-otp-email', [VerifiyEmailController::class, 'sendOtp']);
    Route::post('email-verification', [VerifiyEmailController::class, 'emailVerification']);
    Route::post('send-otp-phone', [VerifiyPhoneController::class, 'sendOtp']);
    Route::post('phone-verification', [VerifiyPhoneController::class, 'phoneVerification']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('/forgetPassword', [ResetPasswordController::class, 'forgetPassword']);
    Route::post('/resetPassword', [ResetPasswordController::class, 'resetPassword']);
});

Route::group(['prefix'=>'profile'],function(){
    Route::post('update-profile',[ProfileUserController::class,'updateProfile']);
    Route::get('show',[ProfileUserController::class,'show']);
    Route::post('update-location',[UserLocationController::class,'updateLocation']);
    Route::get('show-location',[UserLocationController::class,'show']);
});

Route::post('create-ride',[RideController::class,'create']);
Route::get('cancel-ride/{id}',[RideController::class,'cancel']);
Route::get('index',[RideController::class,'index']);
