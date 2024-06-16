<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardingTakeoffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = \Carbon\Carbon::parse($this->planed_date_time);
        return [
            'id' => $this->id,
            'is_boarding' => $this->is_boarding,
            'planed_date' => $date->format('Y-m-d'),
            'planed_time' => $date->format('H:i:s'),
            'flight_number' => $this->flight_number,
            'airport_code' => $this->airport_code,
            'completed_date_time' => $this->completed_date_time,
        ];
    }
}
