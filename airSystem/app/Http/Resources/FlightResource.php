<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'flight_number' => $this->flight_number,
            'board' => $this->board_code,
            'airport_where' => new AirportResource($this->airportWhere),
            'airport_whither' => new AirportResource($this->airportWhither),
            'airline' => new AirlineResource($this->airline),
            'type' => new TypeCategoryResource($this->type),
        ];
    }
}
