<?php

namespace App\Http\Controllers;

use App\Http\Requests\Airline\CreateAirlineRequest;
use App\Http\Requests\Airline\EditAirlineRequest;
use App\Models\Airline;

class AirlineController extends Controller
{
    public function airline()
    {
        return response()->json(Airline::get(), 200);
    }

    public function editAirline(EditAirlineRequest $request, $id)
    {
        $airline = Airline::where('code_iata', $id)->first();

        $data = array_filter($request->validated());
        $airline->update($data);

        return response()->json(["message" => "Airline edited"]);
    }

    public function createAirline(CreateAirlineRequest $request)
    {

        $validatedData = $request->validated();
        if (!$validatedData) {
            return response()->json(["Error" => $request->errors()], 422);
        }
        error_log(json_encode($validatedData));
        Airline::create($validatedData);
        return response()->json(["message" => "Airline created"],201);
    }

    public function deleteAirline($id)
    {
        $airline = Airline::where('code_iata', $id)->first();
        $airline->delete();
        return response()->json(["message" => "Airline removed"]);
    }
}
