<?php
namespace App\Services;

use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class SmsService
{
    protected $vonageClient;

    public function __construct()
    {
        $basic  = new Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
        $this->vonageClient = new Client($basic);
    }

    public function sendOtp($phoneNumber, $otp)
    {
        $message = $this->vonageClient->message()->send([
            'to'   => $phoneNumber,
            'from' => env('VONAGE_SMS_FROM'),
            'text' => 'Your verification code is: ' . $otp
        ]);

        return $message;
    }
}
