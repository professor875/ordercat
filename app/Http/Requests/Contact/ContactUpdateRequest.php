<?php

namespace App\Http\Requests\Contact;

use App\Enums\ContactChannelEnum;
use App\Enums\ContactTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $contactId = $this->route('contact')->id;
        $contactChannel = $this->route('contact')->contact_channel;

        return [
            'name' => 'required|string|max:255',
            'type' => ['required', Rule::enum(ContactTypeEnum::class)],
            'contact_channel' => ['required', Rule::enum(ContactChannelEnum::class)],
            'sms' => [$contactChannel === 'sms' ? 'required' : 'nullable', Rule::unique('contacts')->ignore($contactId)],
            'email' => [$contactChannel === 'email' ? 'required' : 'nullable','email','string','max:255',Rule::unique('contacts')->ignore($contactId)],
            'whatsapp' => [$contactChannel === 'whatsapp' ? 'required' : 'nullable',Rule::unique('contacts')->ignore($contactId)],
            'phone' => [$contactChannel === 'phone' ? 'required' : 'nullable',Rule::unique('contacts')->ignore($contactId)]
        ];
    }
}
