<?php

Route::group(["middleware" => "auth"], function ($router){
    $router->get("/discounts",  [
       "as" => "discounts.index",
       "uses" => "DiscountController@index"
    ]);

    $router->post("/discounts", "DiscountController@store")->name("discounts.store");
    $router->delete("/discounts/{discount}", "DiscountController@destroy")->name("discounts.destroy");
    $router->get("/discounts/{discount}/edit", "DiscountController@edit")->name("discounts.edit");
    $router->patch("/discounts/{discount}", "DiscountController@update")->name("discounts.update");
    $router->get("/discounts/{code}/{course}/check", "DiscountController@check")->name("discounts.check")->middleware("throttle:6,1");
});
