<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'car_type_id',
        'car_model_id',
        'car_color_id',
        'plate_type_id',
        'manufacturing_year_id',
        'numbers','plate_letters',
        'form_expiration',
        'insurance_expiration',
        'form_serial_number',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }
    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }
    public function carColor()
    {
        return $this->belongsTo(CarColor::class);
    }
    public function carImage()
    {
        return $this->hasOne(CarImage::class);
    }
}
