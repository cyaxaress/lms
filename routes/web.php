<?php
Route::get('/', function () {
    return view('index');
});


Route::get('/test', function () {
    auth()->user()->givePermissionTo('manage categories');
    return auth()->user()->permissions;
});
