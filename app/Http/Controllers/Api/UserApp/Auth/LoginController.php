<?php

namespace App\Http\Controllers\Api\UserApp\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Country;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }
    public function login(LoginRequest $request)
    {
        try {

            $country = Country::find($request->country_id);
            if (!$country) {
                return response()->json(['error' => 'Invalid country ID.'], 404);
            }

            $phone = $country->code . $request->phone;

            $user = User::where('phone', $phone)->first();

            if (!$user) {
                return response()->json(['error' => 'User not found.'], 404);
            }


            // $otp1 = $this->otp->validate($phone, $request->otp);

            // if (!$otp1->status) {
            //     return response()->json(['error' => 'Invalid OTP.'], 401);
            // }

            $token = auth()->tokenById($user->id);

            return $this->createNewToken($token);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred during login. Please try again.'], 500);
        }
    }

    protected function createNewToken(string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL()
        ]);
    }
     public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }
}
