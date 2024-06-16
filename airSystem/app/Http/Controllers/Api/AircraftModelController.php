<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AircraftModel\StoreRequest;
use App\Http\Requests\Admin\AircraftModel\UpdateRequest;
use App\Http\Resources\AircraftModelResource;
use App\Models\AircraftModel;

class AircraftModelController extends Controller
{
    public function index()
    {
        return response(AircraftModelResource::collection(AircraftModel::all()), 200);
    }

    public function update(UpdateRequest $request, AircraftModel $model)
    {
        $data = array_filter($request->validated());
        $model->update($data);
        return response()->json(["message" => "AircraftModel edited"]);
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        AircraftModel::create($validatedData);
        return response()->json(["message" => "AircraftModel created"],201);
    }

    public function destroy(AircraftModel $model)
    {
        $model->delete();
        return response()->json(["message" => "AircraftModel removed"]);
    }
}
