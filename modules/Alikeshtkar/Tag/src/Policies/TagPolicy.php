<?php

namespace Alikeshtkar\Tag\Policies;

use Alikeshtkar\Tag\Models\Tag;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_TAGS);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_TAGS);
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_TAGS);
    }

    public function destroy(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_TAGS);
    }
}
