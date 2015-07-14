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

// 一覧表示
Route::get('/', 'SearchController@selectAll');



// リーダー資質ランキング
Route::get('leader_ranking','SearchController@sortLeaderRank');

// サポート資質ランキング
Route::get('support_ranking','SearchController@sortSupportRank');

Route::get('input','SearchController@input');

Route::post('res','SearchController@res');

Route::get('select','SearchController@select');

// 名前検索
Route::get('/{name}', 'SearchController@selectName');
