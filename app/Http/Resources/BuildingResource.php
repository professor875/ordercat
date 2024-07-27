<?php

namespace App\Http\Resources;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Building */
class BuildingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'type' => $this->type?->value,
            'number' => $this->number,
            'inhabitants_count' => $this->inhabitants_count,
            'location_coordinate' => $this->location_coordinate,
            'stages_count' => $this->when(isset($this->stages_count), fn () => $this->stages_count),
        ];
    }
}
