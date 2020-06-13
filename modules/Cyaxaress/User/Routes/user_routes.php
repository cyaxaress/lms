<?php

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'web'
], function ($router) {
    Auth::routes(['verify' => true]);
});
