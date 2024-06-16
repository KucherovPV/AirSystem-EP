<?php

namespace App\Http\Requests\Admin\Airline;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code_iata' => 'string|max:3|required',
            'code_icao' => 'string|max:4|required',
            'name' => 'string|max:130|required',
            'country' => 'string|max:130|required',
            'locale_code' => 'string|max:2|required',
        ];
    }
}
