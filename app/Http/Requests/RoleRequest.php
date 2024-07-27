<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'permissions' => 'required|array|min:1',
            'permissions.*' => ['required', Rule::in(collect(config('constants.permissions'))->pluck('name')->toArray())],
        ];
    }
}
