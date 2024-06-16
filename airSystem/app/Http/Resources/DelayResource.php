<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DelayResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'flight_number' => $this->flight_number,
            'airport_code' => $this->airport_code,
            'approximate_time' => $this->approximate_time / 3600,
            'type_category' => new TypeCategoryResource($this->categoryType),
            'is_process' => $this->is_process,
        ];
    }
}
