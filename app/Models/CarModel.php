<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable=['id','name','cartype_id'];

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }
}
