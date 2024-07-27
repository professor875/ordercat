<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'description' => ['required', 'string', 'max:255'],
            'days' => 'array|required|min:1',
            'days.*' => ['required', Rule::in(config('constants.days'))],
            'types' => 'array|required|min:1',
            'types.*' => ['required', Rule::in(config('constants.itemTypes'))],
        ];
    }
}
