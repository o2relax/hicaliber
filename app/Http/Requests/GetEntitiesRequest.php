<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetEntitiesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'q'          => ['nullable', 'string'],
            'bedrooms'   => ['nullable', 'numeric'],
            'bathrooms'  => ['nullable', 'numeric'],
            'garages'    => ['nullable', 'numeric'],
            'storeys'    => ['nullable', 'numeric'],
            'price_from' => ['nullable', 'numeric'],
            'price_to'   => ['nullable', 'numeric'],
        ];
    }
}
