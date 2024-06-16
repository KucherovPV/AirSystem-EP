<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreRequest;
use App\Http\Requests\Admin\City\UpdateRequest;
use App\Http\Resources\CityResource;
use App\Models\City;


class CityController extends Controller
{
    public function index()
    {
        return response(CityResource::collection(City::all(), 200));
    }

    public function update(UpdateRequest $request, City $city)
    {

        $city->update($request->validated());
        return response()->json(["message" => "City edited"]);
    }

    public function store(StoreRequest $request)
    {
        City::create($request->validated());
        return response()->json(["message" => "City created"],201);
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->json(["message" => "City removed"]);
    }
}
