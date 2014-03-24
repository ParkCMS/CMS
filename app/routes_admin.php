<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes for the admin area
|
*/

Route::get('admin', 'Parkcms\Admin\Dashboard\Controller@index');

Route::get('admin/partials/{name}', 'Parkcms\Admin\Dashboard\Partials@show')->where('name', '[A-Za-z0-9.]+');