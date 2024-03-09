<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        if (auth()->check()) {

            return response()->json(new UserResource(auth()->user()));
        } else {
            return response()->json(['error' => 'Пользователь не аутентифицирован'], 401);
        }
    }
    public function userList()
    {
            return response()->json(User::with('roles' )->get());
    }
    public function userById($id)
    {
        return response()->json(User::with('roles')->find($id));
    }
}
