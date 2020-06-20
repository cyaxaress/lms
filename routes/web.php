<?php
Route::get('/', function () {
    return view('index');
});

Route::get('/home', 'HomeController@index')->name('home');
