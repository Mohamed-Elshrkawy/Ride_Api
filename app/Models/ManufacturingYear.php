<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingYear extends Model
{
    use HasFactory;

    protected $fillable=['id','year'];
}
