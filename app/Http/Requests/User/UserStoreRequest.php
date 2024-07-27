<?php

namespace App\Http\Requests\User;

use App\Enums\ContactChannelEnum;
use App\Enums\ContactTypeEnum;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $contactChannel = $this->contact_channel;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|max:255|min:8|confirmed',
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
