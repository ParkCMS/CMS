<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes for the admin area
|
*/

Route::group(array('prefix' => 'admin', 'before' => 'pcms_auth'), function() {
    Route::get('/', 'Parkcms\Admin\Dashboard\Controller@index');
    Route::get('partials/{name}', 'Parkcms\Admin\Dashboard\Partials@show')
        ->where('name', '[A-Za-z0-9.]+');

    Route::get('files/list', 'Parkcms\Admin\Files\Controller@getFolder');

    Route::get('files/upload', 'Parkcms\Admin\Files\Controller@uploadGet');
    Route::post('files/upload', 'Parkcms\Admin\Files\Controller@uploadPost');

    Route::get('files/mkdir', 'Parkcms\Admin\Files\Controller@mkdir');
});

Route::get('login', array('as' => 'login', 'uses' => 'Parkcms\Auth\LoginController@loginForm'));
Route::post('login/auth', 'Parkcms\Auth\LoginController@authenticate');
Route::get('logout', array('as' => 'logout', 'uses' => 'Parkcms\Auth\LoginController@logout'));

Route::get('files/{path}', 'MediaController@resolveFile')->where('path', '(?:[^<>]*)');