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

Route::get('test3', 'ImportController@import');

Route::group(['prefix'=>'api'], function() {

    // Data Source Resource
    Route::model('ds', ANDS\Registry\DataSource::class);
    Route::resource('ds', 'DataSourceController');

});

Route::get('/test2', function() {
    $ds = ANDS\Registry\DataSource::find(208);
    return $ds;
});

Route::get('/test', function() {
    $ro =  ANDS\Registry\Record::find(555631);
    return $ro;
});
