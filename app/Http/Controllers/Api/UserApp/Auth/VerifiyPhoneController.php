<?php

namespace App\Http\Controllers\Api\UserApp\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifiyPhoneRequest;
use App\Models\Country;
use App\Models\User;
use App\Notifications\Auth\VerifiyPhoneNotification;
use Ichtrojan\Otp\Otp;

class VerifiyPhoneController extends Controller
{

    private $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }
    public function sendOtp(VerifiyPhoneRequest $request)
    {
        $country = Country::find($request->country_id);
        $phone = $country->code . $request->phone;
        $user = User::where('phone',$phone)->first();
        $user->notify(new VerifiyPhoneNotification($this->otp, $phone));
        return response()->json(['message' => 'OTP sent successfully.'], 200);

    }

    public function phoneVerification(VerifiyPhoneRequest $request)
    {
        $country = Country::find($request->country_id);
        $phone = $country->code . $request->phone;
        $otp1 = $this->otp->validate($phone, $request->otp);

        if (!$otp1->status) {
            return response()->json(['error' => 'Invalid OTP.'], 401);
        }

        $user = User::where('phone', $phone)->first();

            $user->update(['phone_verified_at' => now()]);
            return response()->json(['message' => 'User successfully verified phone.'], 200);
    }
}


