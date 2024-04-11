<?php

namespace Cyaxaress\Course\Policies;

use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
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

    public function manage(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }
    }

    public function index($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)) {
            return true;
        }
    }

    public function create($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)) {
            return true;
        }
    }

    public function edit($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $course->teacher_id == $user->id) {
            return true;
        }
    }

    public function delete($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        return null;
    }

    public function change_confirmation_status($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        return null;
    }

    public function details($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $course->teacher_id == $user->id) {
            return true;
        }
    }

    public function createLesson($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $course->teacher_id == $user->id)
        ) {
            return true;
        }
    }

    public function createSeason($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            return true;
        }

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $course->teacher_id == $user->id) {
            return true;
        }
    }

    public function download($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->id === $course->teacher_id ||
            $course->hasStudent($user->id)
        ) {
            return true;
        }

        return false;
    }
}
