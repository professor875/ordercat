<?php

namespace App\Http\Resources;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Stage */
class StageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'orderedFor' => new BuildingResource($this->whenLoaded('orderedFor')),
            'orderedFrom' => new KitchenResource($this->whenLoaded('orderedFrom')),
            'deliveredBy' => new ContactResource($this->whenLoaded('deliveredBy')),
            'handedTo' => new ContactResource($this->whenLoaded('handedTo')),
            'items' => ItemResource::collection($this->whenLoaded('items')),
            'cooked_at' => $this->cooked_at?->toDateTimeString(),
            'packaging_at' => $this->packaging_at?->toDateTimeString(),
            'handed_at' => $this->handed_at?->toDateTimeString(),
            'delivery_at' => $this->delivery_at?->toDateTimeString(),
            'delivered_at' => $this->delivered_at?->toDateTimeString(),
            'createdBy' => new UserResource($this->whenLoaded('createdBy')),
            'started_at' => $this->started_at?->toDateString(),
            'delivery_rating' => $this->delivery_rating,
            'kitchen_rating' => $this->kitchen_rating,
            'employees_rating' => $this->employees_rating,
            'instruments_rating' => $this->instruments_rating,
            'note' => $this->note,
        ];
    }
}
