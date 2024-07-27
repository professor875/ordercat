<?php

namespace App\Http\Resources;

use App\Models\Kitchen;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Kitchen */
class KitchenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'commercial_registration' => $this->commercial_registration,
            'location_coordinate' => $this->location_coordinate,
            'stages_count' => $this->when(isset($this->stages_count), fn () => $this->stages_count)
        ];
    }
}
