<?php


namespace Cyaxaress\RolePermissions\Models;


class Role extends \Spatie\Permission\Models\Role
{
    const ROLE_TEACHER = 'teacher';
    static $roles = [
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH
        ]
    ];
}
