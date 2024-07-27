<?php

namespace App\Http\Requests;

use App\Enums\ContactChannelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        $contactChannel = $this->contact_channel;

        return [
            'name' => 'required|string|max:255',
            'contact_channel' => ['required', Rule::enum(ContactChannelEnum::class)],
            'contact_number' => [
                $contactChannel != 'email' ? 'required' : 'nullable',
                'string',
                'max:255'
            ],
        ];
    }
}
