<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function roles()
    {
        return response()->json(User::getRoles(),200);
    }
    public function user()
    {
        if (auth()->check()) {
            return response()->json(new UserResource(auth()->user()));
        } else {
            return response()->json(['error' => 'Пользователь не аутентифицирован'], 401);
        }
    }
    public function update(UpdateRequest $request, User $user)
    {
        $user->update(array_filter($request->validated()));
    }
    public function store(StoreRequest $request)
    {
        User::create($request->validated());
    }
    public function index()
    {
        return response()->json(UserResource::collection(User::all()));
    }
    public function show($id)
    {
        return response()->json(User::with('roles')->find($id));
    }
    public function destroy(User $user)
    {
        $user->delete();
    }
}
