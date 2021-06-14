<?php

namespace Cyaxaress\Payment\Policies;

use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettlementPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_SETTLEMENTS) ||
            $user->hasPermissionTo(Permission::PERMISSION_TEACH)
        ) return true;
    }

    public function manage($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_SETTLEMENTS)) return true;
    }

    public function store($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_TEACH)) return true;
    }
}
