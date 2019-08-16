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

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Route::group([

    'middleware' => 'api',
    'prefix' => 'car'

], function ($router) {

    Route::post('car', 'CarController@car');
    Route::post('showcar', 'CarController@showcar');
    Route::post('jia', 'CarController@jia');
    Route::post('selectnum', 'CarController@selectnum');
    Route::post('buy', 'CarController@buy');
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'address'

], function ($router) {

    Route::post('area', 'AddressController@area');
    Route::post('addaddress', 'AddressController@addAddress');
    Route::post('address', 'AddressController@address');
    Route::post('update', 'AddressController@update');
    Route::post('alladdress', 'AddressController@alladdress');
    Route::post('shezhi', 'AddressController@shezhi');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'car2'

], function ($router) {

    Route::post('showcar', 'Car2Controller@showcar');
    Route::post('address', 'Car2Controller@address');
    Route::post('jiesuan', 'Car2Controller@jiesuan');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'pay'

], function ($router) {

    Route::get('index', 'PayController@index');
    Route::get('return', 'PayController@return');
    Route::any('notify', 'PayController@notify');
});



