<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RideResource extends JsonResource
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
            'from'=>$this->start_location,
            'to'=>$this->end_location,
            'start time'=>$this->start_time,
            'status'=>$this->status,
            'price'=>$this->price,

        ];
    }
}
