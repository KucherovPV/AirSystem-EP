<?php

namespace App\Http\Requests\Admin\Board;

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
            'board_code' => 'string|max:7|unique:boards,board_code',
            'airline_code' => 'string|max:2|exists:airlines,code_iata',
            'model_id' => 'integer|exists:aircraft_models,id',
            'board_type_id' => 'integer|exists:type_categories,id',
        ];
    }
}
