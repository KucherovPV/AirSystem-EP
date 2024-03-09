<?php

namespace App\Http\Controllers;

use App\Http\Requests\Type\CreateTypeRequest;
use App\Http\Requests\Type\EditTypeRequest;
use App\Models\TypeCategory;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class TypeCategoryController extends Controller
{
    public function typeByCategory($category)
    {
        $data = TypeCategory::where($category, true)->get();
        return response()->json($data);
    }

    public function editType(EditTypeRequest $request, $id)
    {
        $object = TypeCategory::find($id);

        $data_to_update = array_filter($request->validated());

        if (isset($data_to_update['name'])) {

            $name = $data_to_update['name'];
            $object->name = $name;
            error_log($name);
        } elseif (isset($data_to_update['category'])) {

            $category = $data_to_update['category'];
            $object->is_reason_category = false;
            $object->is_flight_type = false;
            $object->is_board_type = false;
            $object->is_reason_status = false;

            $object->$category = true;
            error_log($category);
        }
        $object->save();

        return response()->json(["message" => "Type edited"]);
    }

    public function createType(CreateTypeRequest $request)
    {

        $object = new TypeCategory();
        $data_to_update = array_filter($request->validated());
        $category = $data_to_update['category'];

        $object->name = $data_to_update['name'];
        $object->$category = true;

        $object->save();

        return response()->json(["message" => "Type created"], 201);
    }

    public function deleteType($id)
    {
        $object = TypeCategory::find($id);
        $object->delete();
        return response()->json(["message" => "Type removed"]);
    }
}
