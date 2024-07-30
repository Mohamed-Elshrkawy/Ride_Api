<?php

use App\Http\Controllers\Api\UserApp\App\ConversationController;
use App\Http\Controllers\Api\UserApp\App\CreateCarController;
use App\Http\Controllers\Api\UserApp\App\DriverRideController;
use App\Http\Controllers\Api\UserApp\App\HomeController;
use App\Http\Controllers\Api\UserApp\App\MessageController;
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

Route::group([/*'middleware' => ('verified.user')*/],function(){

    Route::group(['prefix'=>'home'],function(){
        Route::get('/',[HomeController::class,'home']);
        Route::get('active',[HomeController::class,'active']);
        Route::get('my-notification',[HomeController::class,'myNotification']);
        Route::get('my-wallet',[HomeController::class,'myWallet']);

    });
    Route::group(['prefix'=>'profile'],function(){
        Route::post('update-profile',[ProfileUserController::class,'updateProfile']);
        Route::get('show',[ProfileUserController::class,'show']);
        Route::post('update-location',[UserLocationController::class,'updateLocation']);
    });

    Route::group(['prefix'=>'user-ride'],function(){
        Route::post('create-ride',[RideController::class,'create']);
        Route::get('cancel-ride/{id}',[RideController::class,'cancel']);
        Route::get('index',[RideController::class,'index']);
        Route::post('review',[RideController::class,'review']);

    });
    Route::group(['prefix'=>'driver-ride'],function(){
        Route::get('index',[DriverRideController::class,'index']);
        Route::get('accept-ride/{id}',[DriverRideController::class,'accept']);
        Route::get('cancel-ride/{id}',[DriverRideController::class,'cancel']);
        Route::get('start-ride/{id}',[DriverRideController::class,'startRide']);
        Route::get('ride-done/{id}',[DriverRideController::class,'rideDone']);
        Route::post('review',[DriverRideController::class,'review']);


    });

    Route::group(['prefix'=>'car'],function(){
        Route::get('car-type',[CreateCarController::class,'carType']);
        Route::get('car-model/{id}',[CreateCarController::class,'carModel']);
        Route::get('car-color',[CreateCarController::class,'carColor']);
        Route::get('car-color',[CreateCarController::class,'carColor']);
        Route::post('create-car',[CreateCarController::class,'createCar']);
        Route::get('active-car/{id}',[CreateCarController::class,'activeCar']);
        Route::get('my-cars',[CreateCarController::class,'myCar']);




    });




});
Route::post('conversations', [ConversationController::class, 'startConversation']);
Route::get('conversations', [ConversationController::class, 'getConversations']);

Route::post('messages', [MessageController::class, 'sendMessage']);
Route::get('messages/{conversationId}', [MessageController::class, 'getMessages']);

