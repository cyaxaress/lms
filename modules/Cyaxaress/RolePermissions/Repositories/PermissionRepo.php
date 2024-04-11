<?php

namespace Cyaxaress\RolePermissions\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepo
{
    public function all()
    {
        return Permission::all();
    }
}
