<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'SearchController@selectAll');


Route::get('input','SearchController@input');

Route::post('res','SearchController@res');

Route::get('select','SearchController@select');
