<?php
Route::group(["namespace" => "Cyaxaress\Course\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('courses', 'CourseController');
    $router->patch('courses/{course}/accept', 'CourseController@accept')->name('courses.accept');
    $router->patch('courses/{course}/reject', 'CourseController@reject')->name('courses.reject');
    $router->patch('courses/{course}/lock', 'CourseController@lock')->name('courses.lock');
    $router->get('courses/{course}/details', 'CourseController@details')->name('courses.details');
});
