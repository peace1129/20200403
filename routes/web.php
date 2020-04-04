<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// アクセスルート画面
Route::get('/', 'HomeController@index');

// 名簿一覧画面
Route::get('/roster/index', 'RosterController@index');
Route::get('/roster/group_search', 'RosterController@group_search');
Route::get('/roster/create', 'RosterController@create');
Route::get('/roster/createChk', 'RosterController@createChk');
Route::get('/roster/createExec', 'RosterController@createExec');
Route::get('/roster/edit', 'RosterController@edit');
Route::get('/roster/editChk', 'RosterController@editChk');
Route::post('/roster/editExec', 'RosterController@editExec');
Route::get('/roster/delete', 'RosterController@delete');
Route::post('/roster/deleteExec', 'RosterController@deleteExec');

// グループ一覧画面
Route::get('/group/index', 'GroupController@index');
Route::get('/group/create', 'GroupController@create');
Route::get('/group/createChk', 'GroupController@createChk');
Route::post('/group/createExec', 'GroupController@createExec');
Route::get('/group/edit', 'GroupController@edit');
Route::get('/group/editChk', 'GroupController@editChk');
Route::post('/group/editExec', 'GroupController@editExec');
Route::get('/group/delete', 'GroupController@delete');
Route::post('/group/deleteExec', 'GroupController@deleteExec');
