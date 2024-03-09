<?php

namespace App\Http\Controllers;

use App\Http\Requests\Board\CreateBoardRequest;
use App\Http\Requests\Board\EditBoardRequest;
use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function board()
    {
        return response()->json(Board::with('typeCategory')->get());
    }

    public function editBoard(EditBoardRequest $request, $code)
    {
        $airline = Board::where('board_code', $code)->first();
        $data = array_filter($request->validated());
        //error_log($data);
        $airline->update($data);
        return response()->json(["message" => "Board edited"]);
    }

    public function createBoard(CreateBoardRequest $request)
    {

        $validatedData = $request->validated();
        if (!$validatedData) {
            return response()->json(["Error" => $request->errors()], 422);
        }

        Board::create($validatedData);
        return response()->json(["message" => "Board created"],201);
    }

    public function deleteBoard($code)
    {
        $airline = Board::where('board_code', $code)->first();
        $airline->delete();
        return response()->json(["message" => "Board removed"]);
    }
}
