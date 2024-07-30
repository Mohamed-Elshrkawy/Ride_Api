<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable=['available_balance','user_id'];

    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
