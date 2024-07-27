<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'required|string|max:255',
            'ordered_for_id' => 'required|integer|exists:buildings,id',
            'ordered_from_id' => 'required|integer|exists:kitchens,id',
            'delivery_at' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|numeric|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'note' => 'nullable|string|max:255',
        ];
    }
}
