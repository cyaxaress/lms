<?php

Route::group(["namespace" => "Cyaxaress\Category\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('categories', 'CategoryController')->middleware('permission:manage categories');
});
