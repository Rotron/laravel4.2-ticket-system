<?php

Route::pattern('id', '[0-9]+');
Route::pattern('cat', 'all|open|resolved');

Route::group(
    array('before' => 'auth'),
    function () {
        Route::get('tickets', array('as' => 'tickets', 'uses' => 'TicketsController@index'));
        Route::get('tickets/{cat}', array('as' => 'tickets', 'uses' => 'TicketsController@index'));
        Route::get('ticket/{id}', array('as' => 'ticket', 'uses' => 'TicketsController@show'));
        Route::post('ticket', array('as' => 'ticket', 'uses' => 'TicketsController@createPost', 'before' => 'csrf'));
        Route::post('tickets', array('as' => 'tickets', 'uses' => 'TicketsController@create', 'before' => 'csrf'));
        Route::post('changeInfo',array('as' => 'changeInfo', 'uses' => 'UserController@changeInfo', 'before' => 'csrf')
        );
    }
);

Route::get('login', array('as' => 'login', 'uses' => 'LoginController@index'));
Route::post('login', array('as' => 'login', 'uses' => 'LoginController@login', 'before' => 'csrf'));
Route::get('logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));
Route::post('register', array('as' => 'register', 'uses' => 'RegisterController@register', 'before' => 'csrf'));
Route::get('register', array('as' => 'register', 'uses' => 'RegisterController@index'));
Route::get('/', 'LoginController@index');

App::missing(
    function ($exception) {
        return 'Not Found';
    }
);
