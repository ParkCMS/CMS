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

Route::get('/', function()
{
    // @TODO: determine real user language
    $lang = 'de';
    
    $root = Parkcms\Models\Page::roots()->where('title', $lang)->first();
    
    $startPage = $root->children()->first();
    
    if($startPage !== null) {
        return Redirect::to('/' . $startPage->alias);
    }
});

Route::get('/{page}/{attributes?}', 'PageController@showPage')
    ->where(array('attributes' => '[A-Za-z0-9\./]+'));
