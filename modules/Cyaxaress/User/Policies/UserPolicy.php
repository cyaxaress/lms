<?php


namespace Cyaxaress\User\Policies;


use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }
    public function edit($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function manualVerify($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function addRole($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function removeRole($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }

    public function editProfile($user)
    {
        if (auth()->check()) return true;
    }
}
