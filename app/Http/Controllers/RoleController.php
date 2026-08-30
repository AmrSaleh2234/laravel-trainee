<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function createRole() {}


    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function show($id)
    {
        $roles = Role::find($id);
        return response()->json($roles);
    }

    public function store(request $request)
    {
        $role = Role::create([
            "name" => $request->name
        ]);


        $role->permissions()->attach($request->permission_ids);

        return response()->json("created successfully !");
    }


    public function permissions()
    {
        $permissions = Permission::all();

        return response()->json($permissions);
    }

    public function assignRolleToUser(Request $request)
    {
        $user = User::find($request->id);

$user->assignRole('admin');


return response()->json(["message"=>"assigned successfully "]);

    }


    
}
