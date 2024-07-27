<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KitchenRequest extends FormRequest
{
    public function rules():array
    {
        return [
            'title' => 'required|string|max:255',
            'commercial_registration' => 'nullable|string|max:255',
            'location_coordinate' => 'nullable|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
