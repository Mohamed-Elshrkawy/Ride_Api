<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;
    protected $fillable=['name','id'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }
}
