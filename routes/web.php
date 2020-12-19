<?php

use Cyaxaress\Payment\Gateways\Gateway;

Route::get('/test', function () {

//    $gateway = resolve(Gateway::class);
//    $payment = new \Cyaxaress\Payment\Models\Payment();
//    $gateway->request($payment);

//    \Spatie\Permission\Models\Permission::create(['name' => 'manage role_permissions']);
//    auth()->user()->givePermissionTo(\Cyaxaress\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN);
    return auth()->user()->assignRole('teacher');
});
