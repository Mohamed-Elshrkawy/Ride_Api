<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    protected $fillable =['user_id','category_id','driver_id','start_location','end_location','start_time','end_time','distance','price','status'];

    protected $casts = [
        'start_location'=>'array',
        'end_location'=>'array',
        'start_time'=>'datetime',
        'end_time'=>'datetime',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

}
