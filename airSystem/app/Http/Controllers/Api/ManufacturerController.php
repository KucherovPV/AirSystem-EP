<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Manufacturer\StoreRequest;
use App\Http\Requests\Admin\Manufacturer\UpdateRequest;
use App\Http\Resources\ManufacturerResource;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function index()
    {
        return response(ManufacturerResource::collection(Manufacturer::all()), 200);
    }

    public function update(UpdateRequest $request, Manufacturer $manufacturer)
    {
        $data = array_filter($request->validated());
        $manufacturer->update($data);
        return response()->json(["message" => "Manufacturer edited"]);
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        Manufacturer::create($validatedData);
        return response()->json(["message" => "Manufacturer created"],201);
    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return response()->json(["message" => "Manufacturer removed"]);
    }
}
