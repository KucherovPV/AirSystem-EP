<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operator\Flight\StoreRequest;
use App\Http\Requests\Operator\Flight\UpdateRequest;
use App\Http\Resources\FlightResource;
use App\Import\FlightImport;
use App\Models\Flight;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FlightController extends Controller
{
    public function index()
    {
        return response(FlightResource::collection(Flight::all(), 200));
    }

    public function update(UpdateRequest $request, Flight $flight)
    {

        $flight->update($request->validated());
        return response()->json(["message" => "Country edited"]);
    }

    public function store(StoreRequest $request)
    {
        Flight::create($request->validated());
        return response()->json(["message" => "Country created"], 201);
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();
        return response()->json(["message" => "Airline removed"]);
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new FlightImport(), $file);

        return response()->json(['message' => 'Data imported successfully']);
    }
}
