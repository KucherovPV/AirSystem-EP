<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return response(CountryResource::collection(Country::all(), 200));
    }

    public function update(UpdateRequest $request, Country $country)
    {

        $country->update($request->validated());
        return response()->json(["message" => "Country edited"]);
    }

    public function store(StoreRequest $request)
    {
        Country::create($request->validated());
        return response()->json(["message" => "Country created"],201);
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json(["message" => "Airline removed"]);
    }
}
