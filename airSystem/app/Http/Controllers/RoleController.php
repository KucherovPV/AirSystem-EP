<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function role()
    {
        return response()->json(Role::get());
    }

    public function roleById()
    {

    }

    public function DeleteRole()
    {

    }

    public function CreateRole()
    {

    }
    public function userRole()
    {
        return response()->json(['role' => auth()->user()->getRoleNames()[0]]);
    }
}
