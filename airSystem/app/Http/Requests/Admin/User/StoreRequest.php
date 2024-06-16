<?php

namespace App\Http\Requests\Admin\User;

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
            'first_name' => 'string|max:50|required',
            'last_name' => 'string|max:50|required',
            'patronymic' => 'string|max:50|required',
            'email' => 'email|required|unique:users|max:65',
            'role' => 'integer|required',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
