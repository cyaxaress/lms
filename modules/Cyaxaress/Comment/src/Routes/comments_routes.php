<?php
Route::group([], function ($router){
    $router->resource("comments", "CommentController");
});

Route::group([], function ($router){
    $router->get("comments", [
        "uses" => "CommentController@index",
        "as" =>("comments.index")
    ]);
});
