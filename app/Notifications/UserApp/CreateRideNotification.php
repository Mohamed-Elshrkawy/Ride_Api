<?php

namespace App\Notifications\UserApp;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateRideNotification extends Notification
{
    use Queueable;

    protected $ride;
    public function __construct($ride)
    {
        $this->ride=$ride;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'ride_id'=>$this->ride->id,
            'ride_amount'=>$this->ride->amount,
            'ride_date'=>$this->ride->created_at
        ];
    }
}
