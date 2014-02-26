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
	return View::make('hello');
});

Route::get('test', 'HomeController@showWelcome');

Route::get('users', function() {
  $users = User::all();
  return View::make('users')->with('users', $users);
});

Route::post('users', function() {
  $users = User::all();
  return $users;
});

Route::get('/costs', function() {
  $costs = Cost::all();
  return View::make('costs')->with('costs', $costs);
});

Route::post('/costs', function() {
  $type = strtolower(trim($_POST['type']));
  $value = strtolower(trim($_POST['value']));
  $description = ucfirst(trim($_POST['description']));
  if (!empty($value) && !empty($type)) {
    Type::firstOrNew(array('name' => $type))->save();
    $tid_arr = Type::whereName($type)->take(1)->get(array('tid'))->toArray();
    $tid = $tid_arr[0]['tid'];
    $cost = new Cost(array(
      'value' => $value,
      'description' => $description,
      'tid' => $tid,
      'uid' => 1,
      'date' => time(),
    ));
    $cost->save();
  }
  print "<!---->";
  return Redirect::to('/costs');
});