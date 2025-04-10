<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\TimeType;
use App\Enums\SizeType;
use App\Enums\SpiceType;
use App\Enums\FatType;

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
            'id' => $this->id,
            'date' => $this->date,
            'timeOfDay' => TimeType::from($this->time)->name,
            'foodTitle' => $this->food_title,
            'size' => SizeType::from($this->size)->name,
            'spiceLevel' => SpiceType::from($this->spice)->name,
            'fatContent' => FatType::from($this->fat)->name,
            'gluten' => (bool) $this->gluten,
            'dairy' => (bool) $this->dairy,
            'medication' => $this->medication,
        ];
    }
}
