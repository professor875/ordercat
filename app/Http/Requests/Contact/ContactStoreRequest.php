<?php

namespace App\Http\Requests\Contact;

use App\Enums\ContactChannelEnum;
use App\Enums\ContactTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $contactChannel = $this->contact_channel;

        return [
            'name' => 'required|string|max:255',
            'type' => ['required', Rule::enum(ContactTypeEnum::class)],
            'contact_channel' => ['required', Rule::enum(ContactChannelEnum::class)],
            'sms' => [$contactChannel === 'sms' ? 'required' : 'nullable'],
            'email' => [$contactChannel === 'email' ? 'required' : 'nullable' ,"email","max:255","unique:contacts"],
            'whatsapp' => [$contactChannel === 'whatsapp' ? 'required' : 'nullable'],
            'phone' => [$contactChannel === 'phone' ? 'required' : 'nullable'],
        ];
    }
}
