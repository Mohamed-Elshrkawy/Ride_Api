<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverRideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'distance'=>$this->distance,
            'from'=>$this->start_location['name'],
            'to'=>$this->start_location['name'],
            'time'=>$this->start_time,
            'status'=>$this->status,
            'total price'=>$this->price,
            'price'=>$this->price-5,

        ];
        }
}
