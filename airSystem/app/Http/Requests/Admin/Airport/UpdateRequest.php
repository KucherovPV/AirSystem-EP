<?php

namespace App\Http\Requests\Admin\Airport;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code_iata' => 'string|max:3|unique:airports,code_iata',
            'code_icao' => 'string|max:4|unique:airports,code_icao',
            'title' => 'nullable|string|max:130',
            'coordinates' => 'nullable|string|max:130',
            'city_id' => 'integer|required|exists:cities,id',
        ];
    }
}
