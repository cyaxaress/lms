<?php
Route::group(["middleware" => "auth"], function ($router){
    $router->resource("tickets", "TicketController");
    $router->post("tickets/{ticket}/reply", "TicketController@reply")->name("tickets.reply");
    $router->get("tickets/{ticket}/close", "TicketController@close")->name("tickets.close");
});
