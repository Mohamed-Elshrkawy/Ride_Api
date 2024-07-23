<?php

namespace App\Observers\UserApp;

use App\Models\user;
use Illuminate\Support\Facades\Storage;

class ProfileObserver
{
    /**
     * Handle the user "created" event.
     */
    public function created(user $user): void
    {
        //
    }

    /**
     * Handle the user "updated" event.
     */
    public function updating(user $user): void
    {
        if (request()->hasFile('image')) {

            if ($user->getOriginal('image')) {
                Storage::disk('public')->delete($user->getOriginal('image'));
            }
            $user->image = request()->file('image')->store('profile', 'public');
        }
    }

    /**
     * Handle the user "deleted" event.
     */
    public function deleted(user $user): void
    {
        //
    }

    /**
     * Handle the user "restored" event.
     */
    public function restored(user $user): void
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     */
    public function forceDeleted(user $user): void
    {
        //
    }
}
