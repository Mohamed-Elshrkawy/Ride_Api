<?php

namespace App\Notifications\Auth;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class VerifiyPhoneNotification extends Notification
{
    use Queueable;

    private $otp;
    private $phone;

    public function __construct(Otp $otp, $phone)
    {
        $this->otp = $otp;
        $this->phone = $phone;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['vonage'];
    }


    public function toVonage($notifiable): VonageMessage
    {
        $otp = $this->otp->generate($this->phone, 'numeric', 4, 5);
        return (new VonageMessage)
                    ->content('Insert This Code In App: ' . 'code: ' . $otp->token);
    }
}
