<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Role;

/** @mixin Role */

class RoleResource extends JsonResource
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
            'name' => $this->name,
            'permissions_name_array' => $this->whenLoaded('permissions', fn () => $this->permissions->pluck('name')->toArray()),
            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
        ];
    }
}
