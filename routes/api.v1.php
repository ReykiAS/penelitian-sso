<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:token'], function(){

    /**
     * User
     */
	Route::get('user', function (Request $request) {
        return $request->user();
    });
	Route::get('detail', 'App\Http\Controllers\API\V1\Globals\UserController@detail');
	Route::get('logout', 'App\Http\Controllers\API\V1\Globals\UserController@logout')->middleware('auth');

});
Route::post('getSnonce', 'App\Http\Controllers\API\V1\Globals\SSOController@getSnonce')->name('getSnonce');
Route::post('getOtp', 'App\Http\Controllers\API\V1\Globals\SSOController@getOtp')->name('getOtp');
