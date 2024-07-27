<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Item;
use Illuminate\Validation\Rule;

class ItemUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $itemId = $this->route('item')->id;

        return [
            'title' => ['required', Rule::unique('items')->ignore($itemId)],
            'description' => ['required', 'string', 'max:255'],
            'days' => 'array|required|min:1',
            'days.*' => ['required', Rule::in(config('constants.days'))],
            'types' => 'array|required|min:1',
            'types.*' => ['required', Rule::in(config('constants.itemTypes'))],
        ];
    }
}
