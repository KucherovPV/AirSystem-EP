<?php

namespace App\Http\Requests\Admin\Airport;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            'code_iata' => 'string|max:3|required|unique:airports,code_iata',
            'code_icao' => 'string|max:4|required|unique:airports,code_icao',
            'title' => 'string|max:130|required',
            'coordinates' => 'string|max:130|required',
            'city_id' => 'integer|required|exists:cities,id',
        ];
    }
}
