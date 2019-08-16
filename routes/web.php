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


Route::get('users/{user}', function (App\User $user) {
    dd($user);
});


Route::get('login/index', 'LoginController@index');
Route::get('user/login', 'UserController@login');
Route::get('login/login_action', 'LoginController@login_action');
Route::get('login/login_action', 'LoginController@login_action');

Route::get('user/show', 'UserController@show');
Route::get('user/add', 'UserController@add');
Route::get('user/del', 'UserController@del');
Route::get('user/up', 'UserController@up');
Route::get('user/logout', 'UserController@logout');

Route::get('test/test', 'TestController@test');
Route::get('test/fenlei1', 'TestController@fenlei1');
Route::get('test/fenlei2', 'TestController@fenlei2');
Route::get('test/quanbufenlei', 'TestController@quanbufenlei');
Route::get('test/floor', 'TestController@floor');
Route::get('test/price', 'TestController@price');
Route::post('test/price1', 'TestController@price1');
Route::post('test/huopin', 'TestController@huopin');

Route::get('login/md', 'LoginController@md');


