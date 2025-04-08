<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->date,
            'timeOfDay' => $this->time,
            'foodTitle' => $this->food_title,
            'size' => $this->size,
            'spiceLevel' => $this->spice,
            'fatContent' => $this->fat,
            'gluten' => $this->gluten,
            'dairy' => $this->dairy,
            'medication' => $this->medication,
        ];
    }
}
