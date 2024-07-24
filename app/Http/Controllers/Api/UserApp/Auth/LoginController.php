<?php

namespace App\Http\Controllers\Api\UserApp\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Country;
use App\Models\User;
use Ichtrojan\Otp\Otp;

use Exception;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }
    public function login(LoginRequest $request)
    {


            $country = Country::find($request->country_id);

            $phone = $country->code . $request->phone;

            $user = User::where('phone', $request->phone)->first();

            // $otp1 = $this->otp->validate($phone, $request->otp);

            // if (!$otp1->status) {
            //     return response()->json(['error' => 'Invalid OTP.'], 401);
            // }

            $token = auth()->tokenById($user->id);
            return response()->json(['token'=>$token,'user'=>new UserResource($user)],200);

    }
     public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }
}
