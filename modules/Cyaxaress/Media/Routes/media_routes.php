<?php
Route::group([], function ($router) {
    $router->get('/media/{media}/download', 'MediaController@download')->name('media.download');
});
