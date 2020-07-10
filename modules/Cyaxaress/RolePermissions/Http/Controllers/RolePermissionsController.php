<?php
namespace Cyaxaress\RolePermissions\Http\Controllers;

use Spatie\Permission\Models\Role;

class RolePermissionsController
{
    public function index()
    {
        $roles = Role::all();
        return view('RolePermissions::index' , compact('roles'));
    }
}
