<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('login', 'AuthController@login');

Route::group(['prefix' => 'api/v1'], function () {

    Route::group(['prefix' => 'csmp', 'namespace' => 'App\Http\Controllers'], function () {

        Route::get('blocks', 'CsmpController@blocks');

        Route::get('methods', 'CsmpController@methods');
    });

    Route::group(['prefix' => 'csmp', 'namespace' => 'App\Http\Controllers', 'middleware' => ['jwt.auth']], function () {

        Route::post('simulate', 'CsmpController@simulate');

        Route::get('simulation', 'CsmpController@index');

        Route::get('simulation/{id}', 'CsmpController@show');

        Route::post('simulation', 'CsmpController@create');

        Route::delete('simulation/{id}', 'CsmpController@destroy');
    });

    Route::group(['prefix' => 'gpss', 'namespace' => 'App\Http\Controllers', 'middleware' => ['jwt.auth']], function () {

        Route::post('simulate', 'GpssController@simulate');

        Route::get('simulation', 'GpssController@index');

        Route::get('simulation/{id}', 'GpssController@show');

        Route::post('simulation', 'GpssController@create');

        Route::delete('simulation/{id}', 'GpssController@destroy');
    });

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
