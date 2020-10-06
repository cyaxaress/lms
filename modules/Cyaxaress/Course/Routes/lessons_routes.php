<?php
Route::group(["namespace" => "Cyaxaress\Course\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->get('courses/{course}/lessons/create', 'LessonController@create')->name('lessons.create');
    $router->post('courses/{course}/lessons', 'LessonController@store')->name('lessons.store');
    $router->delete('courses/{course}/lessons/{lesson}', 'LessonController@destroy')->name('lessons.destroy');
    $router->delete('courses/{course}/lessons/', 'LessonController@destroyMultiple')->name('lessons.destroyMultiple');
});
