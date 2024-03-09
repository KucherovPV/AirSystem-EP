<?php

namespace App\Http\Controllers;

use App\Http\Requests\Airline\EditAirlineRequest;
use App\Http\Requests\Airport\CreateAirportRequest;
use App\Models\Airport;

class AirportController extends Controller
{
    public function airport()
    {
        return response()->json(Airport::get(), 200);
    }

    public function editAirport(EditAirlineRequest $request, $code)
    {
        $airline = Airport::where('code_iata', $code)->first();

        $data = array_filter($request->validated());
        $airline->update($data);

        return response()->json(["message" => "Airport edited"]);
    }

    public function createAirport(CreateAirportRequest $request)
    {

        $validatedData = $request->validated();
        if (!$validatedData) {
            return response()->json(["Error" => $request->errors()], 422);
        }
        error_log(json_encode($validatedData));
        Airport::create($validatedData);
        return response()->json(["message" => "Airport created"],201);
    }

    public function deleteAirport($code)
    {
        $airline = Airport::where('code_iata', $code)->first();
        $airline->delete();
        return response()->json(["message" => "Airport removed"]);
    }
}
