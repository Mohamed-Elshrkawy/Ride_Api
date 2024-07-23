<?php

namespace App\Notifications\Auth;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class VerificationPhoneNotification extends Notification
{
    use Queueable;

    private $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->otp= new Otp;
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


    public function toVonage($phone): VonageMessage
    {
        $otp = $this->otp->generate($phone,'numeric',4,5);
        return (new VonageMessage)
                    ->content('Insert This Code In App'
                    .'code: '.$otp->token);

    }
}
