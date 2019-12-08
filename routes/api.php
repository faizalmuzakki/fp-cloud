<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'Api',
], function () {
    Route::group([
        'prefix' => 'auth',
    ], function(){
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');

        Route::group([
            'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
        });
    });

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::resource('file', 'FileController')->only(['index', 'store']);
        Route::put('file', 'FileController@update');
        Route::delete('file', 'FileController@destroy');
        Route::post('file/download', 'FileController@download');

        Route::resource('upgrade', 'UpgradeController')->only(['index']);
        Route::put('upgrade', 'UpgradeController@update');
    });
});
