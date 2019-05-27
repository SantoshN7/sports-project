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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'PagesController@index');

Route::get('/createteam','PagesController@createteam')->middleware('auth');

Route::get('/players', 'PlayersController@index');

Route::get('/teams', 'TeamsController@index');

Route::get('/tournament', 'TournamentController@index');
Route::get('participate/{tourid}', 'TournamentController@participate')->middleware('auth');



Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
Route::post('profile_update', 'DashboardController@update')->middleware('auth');
Route::post('add_sport', 'DashboardController@addsport')->middleware('auth');
Route::get('delete_sport/{id}', 'DashboardController@deletesport')->middleware('auth');

Route::get('/notifications', 'NotificationController@index')->middleware('auth');
Route::get('requestUT/{id}', 'NotificationController@requestUT')->middleware('auth');
Route::get('requestTU/{id}', 'NotificationController@requestTU')->middleware('auth');
Route::get('ADDTOTEAM/{id}', 'NotificationController@ADDTOTEAM')->middleware('auth');
Route::get('DECLINE/{id}', 'NotificationController@DECLINE')->middleware('auth');
Route::get('JOINTEAM/{id}', 'NotificationController@JOINTEAM')->middleware('auth');
Route::get('hide/{id}', 'NotificationController@HIDE')->middleware('auth');

Route::get('/team','TeamController@index')->middleware('auth');
Route::post('create_team','TeamController@create')->middleware('auth');
Route::get('show/{id}', 'TeamController@show')->middleware('auth');
Route::get('edit/{id}', 'TeamController@edit')->middleware('auth');
Route::get('delete/{id}', 'TeamController@delete')->middleware('auth');
Route::post('team_update', 'TeamController@update')->middleware('auth');
Route::post('add_sport2', 'TeamController@addsport2')->middleware('auth');
Route::get('delete_sport2/{id}/{teamid}', 'TeamController@deletesport2')->middleware('auth');
Route::get('kick/{id}/{teamid}', 'TeamController@kick')->middleware('auth');
Route::get('makeleader/{id}/{teamid}', 'TeamController@leader')->middleware('auth');
Route::get('LEAVETEAM/{id}', 'TeamController@LEAVETEAM')->middleware('auth');
