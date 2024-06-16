<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Airline\UpdateRequest;
use App\Http\Requests\Admin\Airport\StoreRequest;
use App\Http\Resources\AirportResource;
use App\Models\Airport;

class AirportController extends Controller
{
    public function index()
    {
        return response(AirportResource::collection(Airport::all()), 200);
    }

    public function update(UpdateRequest $request, Airport $airport)
    {
        $data =$request->validated();
        $airport->update($data);
        return response()->json(["message" => "Airport edited"]);
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        Airport::create($validatedData);
        return response()->json(["message" => "Airport created"],201);
    }

    public function destroy(Airport $airport)
    {
        $airport->delete();
        return response()->json(["message" => "Airport removed"]);
    }
}
