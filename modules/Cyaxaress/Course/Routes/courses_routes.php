<?php
Route::group(["namespace" => "Cyaxaress\Course\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('courses', 'CourseController');
});
