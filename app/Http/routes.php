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

Route::get('/', function () {
    return view('welcome');
});
Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::group(array('prefix' => 'admin', 'middleware' => 'auth'), function() {
    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    //Team 
    Route::get('/team', 'Admin\TeamController@index')->name('admin.team');
    Route::get('/create/team', 'Admin\TeamController@create');
    Route::post('store/team', 'Admin\TeamController@store');
    Route::get('/team/{id}/delete', 'Admin\TeamController@delete');
    Route::get('/team/{id}/edit', 'Admin\TeamController@edit');
    Route::post('/team/update/{id}', 'Admin\TeamController@update');
    //Player
    Route::get('/player', 'Admin\PlayerController@index')->name('admin.player');
    Route::get('/create/player', 'Admin\PlayerController@create');
    Route::post('store/player', 'Admin\PlayerController@store');
    Route::get('/player/{id}/delete', 'Admin\PlayerController@delete');
    Route::get('/player/{id}/edit', 'Admin\PlayerController@edit');
    Route::post('/player/update/{id}', 'Admin\PlayerController@update');
});
Route::group(array('prefix' => 'api'), function() {
    //Team 
    Route::get('/scoccer/teams', 'Api\SoccerController@getAllTeam');
    //Player
    Route::get('/scoccer/players/teamid/{id}', 'Api\SoccerController@getAllPlayer');
});

Route::auth();
Route::get('/home', 'HomeController@index');
