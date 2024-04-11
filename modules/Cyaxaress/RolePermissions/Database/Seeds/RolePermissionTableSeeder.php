<?php

namespace Cyaxaress\RolePermissions\Database\Seeds;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\Cyaxaress\RolePermissions\Models\Permission::$permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        foreach (\Cyaxaress\RolePermissions\Models\Role::$roles as $name => $permissions) {
            Role::findOrCreate($name)->givePermissionTo($permissions);
        }
    }
}
