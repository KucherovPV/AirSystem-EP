<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'flight_number' =>$this->flight_number,
            'flight' => new FlightResource($this->flight),
            'boarding_time' => $this->boarding_time,
            'takeoff_time' => $this->takeoff_time,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'days' => DayResource::collection($this->days)
        ];
    }
}
