<?php
Route::group([], function ($router){
    $router->post("/comments/{commentable}", "CommentController@store")->name("comments.store");
});
