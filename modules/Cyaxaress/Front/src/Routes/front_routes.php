<?php
Route::group(['middleware' => ['web'], 'namespace' => 'Cyaxaress\Front\Http\Controllers'],
    function ($router) {
        $router->get('/', 'FrontController@index');
    });
