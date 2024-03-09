<?php

namespace App\Http\Requests\Airport;

use Illuminate\Foundation\Http\FormRequest;

class EditAirportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code_iata' => 'nullable|string|max:3',
            'code_icao' => 'nullable|string|max:4',
            'name' => 'nullable|string|max:130',
            'coordinates' => 'nullable|string|max:130',
            'city' => 'nullable|string|max:130',
            'country' => 'nullable|string|max:130',
        ];
    }
}
