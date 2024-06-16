<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Board\StoreRequest;
use App\Http\Requests\Admin\Board\UpdateRequest;
use App\Http\Resources\BoardResource;
use App\Models\Board;

class BoardController extends Controller
{
    public function index()
    {
        return response(BoardResource::collection(Board::all()));
    }

    public function update(UpdateRequest $request, Board $board)
    {
        $data = array_filter($request->validated());
        $board->update($data);
        return response()->json(["message" => "Board edited"]);
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        Board::create($validatedData);
        return response()->json(["message" => "Board created"],201);
    }

    public function destroy(Board $board)
    {
        $board->delete();
        return response()->json(["message" => "Board removed"]);
    }
}
