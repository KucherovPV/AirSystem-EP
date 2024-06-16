<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delay;
use Illuminate\Http\Request;

class DelayController extends Controller
{
    public function createDelay(Request $request)
    {
        $validatedData = validator($request->all(), [
            'approximate_time' => 'required|string|max:42',
            'fk_airport' => 'required|string|max:4',
            'fk_flight' => 'required|string|max:12',
            'fk_reason_status' => 'required|integer',
            'fk_reason_change' => 'required|integer',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }
        $requestData = $request->only('approximate_time', 'fk_airport', 'fk_flight', 'fk_reason_status', 'fk_reason_change');
        // Создание записи
        Delay::create($requestData);
        return response()->json($requestData, 201);
    }

    public function delay()
    {
        $data = Delay::with('categoryType', 'changeReason', 'flight' )->get();
        return response()->json($data, 200);
    }

}
