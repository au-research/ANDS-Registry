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
  return Response::view('welcome');
});

Route::get('/test2', function() {
    $ds = ANDS\Registry\DataSource::find(208);
    return $ds->records;
    return $ds;
});

Route::get('/test', function() {
    $ro =  ANDS\Registry\Record::find(555631);
    return $ro;
});
