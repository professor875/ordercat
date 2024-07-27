<?php

namespace App\Http\Requests;

use App\Enums\BuildingTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuildingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'type' => ['required', Rule::enum(BuildingTypeEnum::class)],
            'number' => 'nullable|string|max:255',
            'inhabitants_count' => 'required|integer',
            'location_coordinate' => 'nullable|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
