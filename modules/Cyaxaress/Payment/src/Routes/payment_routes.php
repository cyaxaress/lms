<?php

Route::group([], function ($router) {
    $router->any('payments/callback', 'PaymentController@callback')->name('payments.callback');
    $router->get('payments', [
        'uses' => 'PaymentController@index',
        'as' => ('payments.index'),
    ]);

    $router->get('purchases', [
        'uses' => 'PaymentController@purchases',
        'as' => ('purchases.index'),
    ]);
});
