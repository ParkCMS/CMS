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

Route::get('/', function()
{
	$lang = 'de'; // magic to get lang
	
	$root = Parkcms\Models\Page::roots()->where('title', $lang)->first();
	
	$startPage = $root->children()->first();
	
	if($startPage !== null) {
		// $startPage->route();
		
		return Redirect::to('/' . $startPage->alias);
	}
});

Route::get('/{page}', 'PageController@showPage');