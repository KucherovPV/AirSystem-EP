<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Airline\StoreRequest;
use App\Http\Requests\Admin\Airline\UpdateRequest;
use App\Http\Resources\AirlineResource;
use App\Models\Airline;

class AirlineController extends Controller
{
    public function index()
    {
        return response(AirlineResource::collection(Airline::all()), 200);
    }

    public function update(UpdateRequest $request, $id)
    {
        $airline = Airline::where('code_iata', $id)->first();
        $data = $request->validated();
        $airline->update($data);
        return response()->json(["message" => "Airline edited"]);
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        Airline::create($validatedData);
        return response()->json(["message" => "Airline created"],201);
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();
        return response()->json(["message" => "Airline removed"]);
    }
}
