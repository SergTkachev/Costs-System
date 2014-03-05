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

Route::get('/', function() {
  return View::make('frontpage');
});

Route::get('users', function() {
  $users = User::all();
  return View::make('users')->with('users', $users);
});

Route::post('users', function() {
  $users = User::all();
  return $users;
});

Route::get('/costs', 'CostController@getCosts');

Route::get('/api/costs', 'CostController@getApiCosts');

Route::post('/costs', 'CostController@addCost');

Route::post('/api/costs', 'CostController@addApiCost');