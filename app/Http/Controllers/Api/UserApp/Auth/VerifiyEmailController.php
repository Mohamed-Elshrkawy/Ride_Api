<?php

namespace App\Http\Controllers\Api\UserApp\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifiyEmailRequest;
use App\Models\User;
use App\Notifications\Auth\VerifiyEmailNotification;
use Ichtrojan\Otp\Otp;

class VerifiyEmailController extends Controller
{
    private $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }
    public function sendOtp(VerifiyEmailRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        $user->notify(new VerifiyEmailNotification());
        return response()->json(['message' => 'OTP sent successfully.'], 200);

    }

    public function emailVerification(VerifiyEmailRequest $request)
    {
        $otp1 = $this->otp->validate($request->email, $request->otp);

        if (!$otp1->status) {
            return response()->json(['error' => 'Invalid OTP.'], 401);
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['email_verified_at' => now()]);
        return response()->json(['message' => 'User successfully verified email.',], 200);
    }

}
