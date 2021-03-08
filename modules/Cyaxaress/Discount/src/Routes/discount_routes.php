<?php

Route::group(["middleware" => "auth"], function ($router){
    $router->get("/discounts",  [
       "as" => "discounts.index",
       "uses" => "DiscountController@index"
    ]);
});
