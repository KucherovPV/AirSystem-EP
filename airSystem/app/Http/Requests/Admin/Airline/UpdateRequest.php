<?php

namespace App\Http\Requests\Admin\Airline;

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
            'code_iata' => 'nullable|string|max:3',
            'code_icao' => 'nullable|string|max:4',
            'name' => 'nullable|string|max:130',
            'country' => 'nullable|string|max:130',
            'locale_code' => 'nullable|string|max:2',
        ];
    }
}
