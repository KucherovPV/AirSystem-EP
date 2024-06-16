<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Type\StoreRequest;
use App\Http\Requests\Admin\Type\UpdateRequest;
use App\Models\TypeCategory;

class TypeCategoryController extends Controller
{
    public function show($category)
    {
        $data = TypeCategory::where($category, true)->get();
        return response()->json($data);
    }

    public function update(UpdateRequest $request, TypeCategory $type)
    {
        $data = $request->validated();

        if (isset($data['title'])) {

            $name = $data['title'];
            $type->title = $name;
            error_log($name);
        } elseif (isset($data['category'])) {

            $category = $data['category'];
            $type->is_reason_category = false;
            $type->is_flight_type = false;
            $type->is_board_type = false;
            $type->is_reason_status = false;

            $type->$category = true;
            error_log($category);
        }
        $type->save();

        return response()->json(["message" => "Type edited"]);
    }

    public function store(StoreRequest $request)
    {

        $typeCategory = new TypeCategory();
        $data = $request->validated();
        $category = $data['category'];

        $typeCategory->title = $data['title'];
        $typeCategory->$category = true;

        $typeCategory->save();

        return response()->json(["message" => "Type created"], 201);
    }

    public function destroy(TypeCategory $type)
    {
        $type->delete();
        return response()->json(["message" => "Type removed"]);
    }
}
