<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'Trade mark' => $this->carType,
            'Model' => $this->carModel->name,
            'Color' => $this->carColor->color,
            'Numbers'=>$this->numbers,
            'status'=>$this->status
        ];
    }
}
