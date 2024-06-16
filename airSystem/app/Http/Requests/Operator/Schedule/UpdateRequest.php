<?php

namespace App\Http\Requests\Operator\Schedule;

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
            'flight_number' => 'string|max:11|nullable|exists:flights,flight_number',
            'start_date' => 'nullable|date_format:d.m.Y',
            'end_date' => 'nullable|date_format:d.m.Y',
            'boarding_time' => 'nullable|date_format:H:i',
            'takeoff_time' => 'nullable|date_format:H:i',
            'day_ids' => 'array|nullable',
            'day_ids.*' => 'nullable|integer|exists:days,id',
        ];
    }
}
