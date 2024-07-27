<?php

namespace App\Http\Resources;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Contact */
class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type?->value,
            'contact_channel' => $this->contact_channel?->value,
            'sms' => $this->sms,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'phone' => $this->phone,
        ];
    }
}
