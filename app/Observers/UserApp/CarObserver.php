<?php

namespace App\Observers\UserApp;

use App\Models\Car;
use App\Models\CarImage;

class CarObserver
{
    /**
     * Handle the Car "created" event.
     */
    public function created(Car $car)
    {
        $images = [];

        if (request()->hasFile('form_image')) {
            $images['form_image'] = request()->file('form_image')->store('car_images', 'public');
        }
        if (request()->hasFile('Insurance_image')) {
            $images['Insurance_image'] = request()->file('Insurance_image')->store('car_images', 'public');
        }
        if (request()->hasFile('delegation_image')) {
            $images['delegation_image'] = request()->file('delegation_image')->store('car_images', 'public');
        }
        if (request()->hasFile('Front_image')) {
            $images['Front_image'] = request()->file('Front_image')->store('car_images', 'public');
        }
        if (request()->hasFile('back_image')) {
            $images['back_image'] = request()->file('back_image')->store('car_images', 'public');
        }
        if (request()->hasFile('the_lift_side_image')) {
            $images['the_lift_side_image'] = request()->file('the_lift_side_image')->store('car_images', 'public');
        }
        if (request()->hasFile('the_righ_side_image')) {
            $images['the_righ_side_image'] = request()->file('the_righ_side_image')->store('car_images', 'public');
        }
        if (request()->hasFile('front_seat_image')) {
            $images['front_seat_image'] = request()->file('front_seat_image')->store('car_images', 'public');
        }
        if (request()->hasFile('back_seat_image')) {
            $images['back_seat_image'] = request()->file('back_seat_image')->store('car_images', 'public');
        }

        CarImage::create(array_merge(['car_id' => $car->id], $images));
    }


    /**
     * Handle the Car "updated" event.
     */
    public function updated(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "deleted" event.
     */
    public function deleted(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "restored" event.
     */
    public function restored(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "force deleted" event.
     */
    public function forceDeleted(Car $car): void
    {
        //
    }
}
