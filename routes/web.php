<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
 * Authentication System...!!!NEVER EVER MESS WITH THESE !!!
 *
 * */
Route::group(['prefix'=>'cms',                'as'=>'cms.',             'namespace'=>'Auth\\'], function(){
    $this->get('',                           ['as'=>'login',             'uses'=>'LoginController@getLogin']);
    $this->post('',                          ['as'=>'login',             'uses'=>'LoginController@login']);
    $this->get('logout',                     ['as'=>'logout',            'uses'=>'LoginController@logout']);
});
/*
 * End Authentication
 * */

/*
 *  Application Core-Start
 * */

$this->group(['prefix'=>'cms/',                 'as'=>'cms.',               'middleware'=>'auth',      'namespace'=>'Admin\\'], function() {
    $this->get('dashboard',                     ['as'=>'dashboard',   'uses'=>'DashboardController']);
});

