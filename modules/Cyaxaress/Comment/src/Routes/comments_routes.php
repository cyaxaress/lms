<?php
Route::group([], function ($router){
    $router->resource("comments", "CommentController");
});
