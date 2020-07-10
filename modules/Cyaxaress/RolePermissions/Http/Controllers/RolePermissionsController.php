<?php
namespace Cyaxaress\RolePermissions\Http\Controllers;

use Cyaxaress\RolePermissions\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('RolePermissions::index' , compact('roles', 'permissions'));
    }

    public function store(RoleRequest $request)
    {

    }
}
