<?php

namespace App\Notifications\UserApp;

use Illuminate\Bus\Queueable;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ReviewNotification extends Notification
{
    use Queueable;
    protected $review;
    public function __construct($review)
    {
        $this->review=$review;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $name=Auth::user()->name;
        return [
            'review_from'=>$name,
            'ride_id'=>$this->review->ride_id,
            'rateing'=>$this->review->rating,
            'created_at'=>$this->review->created_at
        ];
    }
}
