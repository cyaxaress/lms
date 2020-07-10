<?php
namespace Cyaxaress\RolePermissions\Http\Controllers;

use Cyaxaress\RolePermissions\Http\Requests\RoleRequest;
use Cyaxaress\RolePermissions\Repositories\PermissionRepo;
use Cyaxaress\RolePermissions\Repositories\RoleRepo;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController
{
    private $roleRepo;
    public function __construct(RoleRepo $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }
    public function index(  PermissionRepo $permissionRepo)
    {
        $roles = $this->roleRepo->all();
        $permissions = $permissionRepo->all();
        return view('RolePermissions::index' , compact('roles', 'permissions'));
    }

    public function store(RoleRequest $request)
    {
        return $this->roleRepo->create($request);
    }
}
