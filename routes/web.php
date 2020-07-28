<?php
Route::get('/', function () {
    return view('index');
});


Route::get('/test', function () {
//    \Spatie\Permission\Models\Permission::create(['name' => 'manage role_permissions']);
    auth()->user()->givePermissionTo('teach');
    return auth()->user()->permissions;
});
