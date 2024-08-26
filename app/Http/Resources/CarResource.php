<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class CarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'description' => $this->description,
            'car_body_id' => $this->body_id
        ];
    }
    public function with($request)
    {
        return [
            'success' => true,
        ];
    }
}
