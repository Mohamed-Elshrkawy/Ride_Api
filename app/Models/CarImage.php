<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    use HasFactory;
    protected $fillable=[
        'car_id',
        'form_image',
        'Insurance_image',
        'delegation_image',
        'Front_image',
        'back_image',
        'the_lift_side_image',
        'the_righ_side_image',
        'front_seat_image',
        'back_seat_image'

    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
