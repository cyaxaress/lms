<?php

namespace Cyaxaress\RolePermissions\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepo
{
    public function all()
    {
        return Role::all();
    }

    public function create($request)
    {
        return Role::create(['name' => $request->name])->syncPermissions($request->permissions);
    }
}
