<?php

Route::group([], function ($router) {
    $router->resource('comments', 'CommentController');
    $router->patch('comments/{comment}/accept', 'CommentController@accept')->name('comments.accept');
    $router->patch('comments/{comment}/reject', 'CommentController@reject')->name('comments.reject');
});

Route::group([], function ($router) {
    $router->get('comments', [
        'uses' => 'CommentController@index',
        'as' => ('comments.index'),
    ]);
});
