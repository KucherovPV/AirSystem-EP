<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'board_code' => $this->board_code,
            'airline' => new AirlineResource($this->airline),
            'model' => new AircraftModelResource($this->model),
            'type' => new TypeCategoryResource($this->type),
        ];
    }
}
