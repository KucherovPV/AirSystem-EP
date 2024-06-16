<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AirlineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code_iata' => $this->code_iata,
            'code_icao' => $this->code_icao,
            'title' => $this->title,
            'country' => new CountryResource($this->country),
        ];
    }
}