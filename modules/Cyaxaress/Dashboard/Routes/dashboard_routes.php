<?php
Route::group(['namespace' => 'Cyaxaress\Dashboard\Http\Controllers'], function ($router) {
    $router->get('/home', 'DashboardController@home')->name('home');
});
