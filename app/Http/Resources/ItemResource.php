<?php

namespace App\Http\Resources;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Item */
class ItemResource extends JsonResource
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
            'description' => $this->description,
            'days' => $this->days,
            'types' => $this->types,

            'stages_count' => $this->when(isset($this->stages_count), fn () => $this->stages_count),

            $this->mergeWhen(
                $this->hasPivotLoaded('stage_item'),
                fn () => [
                    'quantity' => $this->pivot->quantity,
                    'rating' => $this->pivot->item_rating,
                ]
            )
        ];
    }
}
