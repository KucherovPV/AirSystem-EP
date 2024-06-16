<?php

namespace App\Http\Requests\Operator\Flight;

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
            'flight_number' => 'string|max:11|required|unique:flights,flight_number',
            'board_code' => 'string|max:11|required|exists:boards,board_code',
            'airport_code_where' => 'string|max:3|required|exists:airports,code_iata',
            'airport_code_whither' => 'string|max:3|required|exists:airports,code_iata',
            'airline_code' => 'string|max:2|required|exists:airlines,code_iata',
            'flight_type_id' => 'integer|required|exists:type_categories,id',
        ];
    }
}
