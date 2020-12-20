<?php

Route::group([], function($router){
    $router->any("payments/callback", "PaymentController@callback")->name("payments.callback");
});
