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

Route::get('/{lang?}', 'PageController@index')
   ->where(array(
        'lang' => '[a-z]{2}(_[A-Z]{2})?'
    ));

Route::get('/{lang}/{page}/{attributes?}', 'PageController@showPage')
    ->where(array(
        'lang' => '[a-z]{2}(_[A-Z]{2})?',
        'attributes' => '[A-Za-z0-9\./]+'
    ));
