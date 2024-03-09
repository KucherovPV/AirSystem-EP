<?php

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;

class EditBoardRequest extends FormRequest
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
            'board_code' => 'nullable|string|max:10',
            'name' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:130',
            'manufacturer' => 'nullable|string|max:50',
            'fk_board_type' => 'nullable|integer',
        ];
    }
}
