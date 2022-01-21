<?php
Route::group(["middleware" => ["auth"]], function ($router){
    $router->resource("slides", "SlideController");
});
