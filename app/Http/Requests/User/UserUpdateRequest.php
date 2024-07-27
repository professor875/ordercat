<?php

namespace App\Http\Requests\User;

use App\Enums\ContactChannelEnum;
use App\Enums\ContactTypeEnum;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $contactChannel = $this->route('user')->contact_channel;

        return [
            'name' => 'required|string|max:255',
            'contact_channel' => ['required', Rule::enum(ContactChannelEnum::class)],
            'contact_number' => [
                $contactChannel != 'email' ? 'required' : 'nullable',
                'string',
                'max:255'
            ],
            'roles' => 'array|required|min:1',
            'roles.*' => ['required', Rule::in(Role::excludePermanentRoles()->get()->pluck('name')->toArray())],
        ];
    }
}
