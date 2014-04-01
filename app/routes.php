<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

include_once __DIR__ . "/routes_admin.php";

Route::any('/api/program/{lang}/{page}/{type}/{identifier}/{attributes?}', 'ProgramController@render')
    ->where(array(
        'attributes' => '[A-Za-z0-9\./]+'
    ));

Route::any('/{lang?}', 'PageController@index')
   ->where(array(
        'lang' => '[a-z]{2}(_[A-Z]{2})?'
    ));

Route::any('/{lang}/{page}/{attributes?}', 'PageController@showPage')
    ->where(array(
        'lang' => '[a-z]{2}(_[A-Z]{2})?',
        'attributes' => '[A-Za-z0-9\./]+'
    ));
