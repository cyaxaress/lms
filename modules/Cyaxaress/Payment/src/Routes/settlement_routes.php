<?php
Route::group(["middleware" => "auth"], function ($router) {
    $router->get("settlements", [
            "as" => "settlements.index",
            "uses" => "SettlementController@index"
        ]
    );
    $router->get("settlements/create",
        [
            "as" => "settlements.create",
            "uses" => "SettlementController@create"
        ]);

    $router->get("settlements/{settlement}/edit",
        [
            "as" => "settlements.edit",
            "uses" => "SettlementController@edit"
        ]);

    $router->patch("settlements/{settlement}",
        [
            "as" => "settlements.update",
            "uses" => "SettlementController@update"
        ]);
    $router->post("settlements", "SettlementController@store")->name("settlements.store");
});
