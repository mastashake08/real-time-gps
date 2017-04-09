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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/* Commands */
Route::group(['prefix' => 'command'], function(){
  Route::get('start-gps', 'LocationController@startGps');
  Route::get('stop-gps','LocationController@stopGps');
});

/* Activation */
Route::group(['prefix' => 'activation'], function(){
  Route::get('/','ActivationController@getView');
  Route::post('/','ActivationController@activateDevice');
  Route::post('/register','ActivationController@registerDevice');
});
