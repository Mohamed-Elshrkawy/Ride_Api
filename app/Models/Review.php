<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'message','ride_id', 'reviewable_id', 'reviewable_type'];

    public function reviewable()
    {
        return $this->morphTo();
    }
}

