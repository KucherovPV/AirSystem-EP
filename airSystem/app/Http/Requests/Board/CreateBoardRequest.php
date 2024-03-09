<?php

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;

class CreateBoardRequest extends FormRequest
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
            'board_code' => 'string|max:10|required',
            'name' => 'string|max:50|required',
            'country' => 'string|max:130|required',
            'manufacturer' => 'string|max:50|required',
            'fk_board_type' => 'integer|required',
        ];
    }
}
