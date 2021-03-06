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

    Route::get('files/move', 'Parkcms\Admin\Files\Controller@move');
    Route::get('files/rename', 'Parkcms\Admin\Files\Controller@rename');

    Route::get('files/delete', 'Parkcms\Admin\Files\Controller@deleteFile');
    Route::get('files/deleteFolder', 'Parkcms\Admin\Files\Controller@deleteFolder');

    Route::any('programs/editor', 'Parkcms\Admin\Programs\EditorController@index');

    Route::get('pages/tree', 'Parkcms\Admin\Pages\Controller\Pages@pageTree');
    Route::get('pages/templates', 'Parkcms\Admin\Pages\Controller\Pages@availableTemplates');
    Route::get('pages/list', 'Parkcms\Admin\Pages\Controller\Pages@linkList');

    Route::post('pages/create', 'Parkcms\Admin\Pages\Controller\Pages@create');
    Route::post('pages/update', 'Parkcms\Admin\Pages\Controller\Pages@update');
    Route::delete('pages/delete', 'Parkcms\Admin\Pages\Controller\Pages@delete');

    Route::get('users/get', 'Parkcms\Admin\Users\Controller@getUserList');
    Route::post('users/create', 'Parkcms\Admin\Users\Controller@create');
    Route::post('users/update', 'Parkcms\Admin\Users\Controller@update');

    Route::get('preview/template/{template}', 'Parkcms\Admin\Pages\Controller\Preview@previewTemplate');
});

Route::get('login', array('as' => 'login', 'uses' => 'Parkcms\Auth\LoginController@loginForm'));
Route::post('login/auth', 'Parkcms\Auth\LoginController@authenticate');
Route::get('logout', array('as' => 'logout', 'uses' => 'Parkcms\Auth\LoginController@logout'));

Route::get('files/{path}', 'MediaController@resolveFile')->where('path', '(?:[^<>]*)');