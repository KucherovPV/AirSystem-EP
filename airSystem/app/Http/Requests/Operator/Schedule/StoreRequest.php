<?php

namespace App\Http\Requests\Operator\Schedule;

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
            'flight_number' => 'string|max:11|required|exists:flights,flight_number',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'boarding_time' => 'required|date_format:H:i:s',
            'takeoff_time' => 'required|date_format:H:i:s',
            'day_ids' => 'array|required',
            'day_ids.*' => 'required|integer|exists:days,id',
        ];
    }
}
