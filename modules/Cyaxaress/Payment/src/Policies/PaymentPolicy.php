<?php

namespace Cyaxaress\Payment\Policies;

use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manage($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_PAYMENTS)) return true;
    }
}
