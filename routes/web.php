<?php
Route::get('/', function () {
    return view('index');
});


Route::get('/test', function () {
//    \Spatie\Permission\Models\Permission::create(['name' => 'manage role_permissions']);
//    auth()->user()->givePermissionTo(\Cyaxaress\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN);
    return auth()->user()->assignRole('teacher');
});
