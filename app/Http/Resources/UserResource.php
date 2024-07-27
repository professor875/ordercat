<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'roles' => $this->whenLoaded('roles', fn () => $this->roles->pluck('name')->toArray()),
            'permissions_name_array' => $this->when(
                $this->relationLoaded('roles') && $this->roles->every(fn ($role) => $role->relationLoaded('permissions')),
                fn () => $this->roles->pluck('permissions')->flatten()->pluck('name')->toArray()
            ),
            'name' => $this->name,
            'email' => $this->email,
            'contact_channel' => $this->contact_channel?->value,
            'contact_number' => $this->contact_number,
            'dp' => $this->whenLoaded(
                'media',
                fn () => $this->getFirstMedia('dp') ? $this->getFirstMediaUrl('dp') : asset('/assets/images/avatar.jpeg')
            ),
        ];
    }
}
