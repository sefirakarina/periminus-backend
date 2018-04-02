<?php	

use Illuminate\Http\Request;

Route::group([

    //'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');

});



//BOOKS
Route::get('book/all', 'BookController@index');
Route::get('book/{id}', 'BookController@show');
Route::get('book/delete/{id}', 'BookController@destroy');
Route::post('book/add', 'BookController@add');
Route::patch('book/update/{id}', 'BookController@update');


//ORDER
Route::get('order/index', 'OrderController@index');
Route::get('order/cust/{id}', 'OrderController@showByCustId');
Route::get('order/delete/{id}', 'OrderController@destroy');
Route::post('order/add', 'OrderController@add');
Route::patch('order/admin/update/{id}', 'OrderController@adminUpdate');
Route::get('order/show', 'OrderController@showOrdersAllData');
Route::get('order/show/{id}', 'OrderController@orderShowUserId');

Route::post('cart/make/{user_id}/{books_id}/{quantity}', 'CartController@makeCart');
Route::post('order/make/{user_id}/{books_id}/{quantity}', 'OrderController@makeOrder');



//CART
Route::get('cart/all/{id}', 'CartController@cartAllData');

Route::get('cart/index', 'CartController@index');
//Route::get('cart/{id}', 'CartController@show');
Route::get('cart/cust/{id}', 'CartController@showByCustId');
Route::get('cart/book/{id}', 'CartController@showByBookId');
Route::get('cart/delete/{id}', 'CartController@destroy');
Route::post('cart/add', 'CartController@add');
Route::patch('cart/update/{id}', 'CartController@update');

Route::get('cart/show/{id}', 'CartController@showById');
Route::get('cart/show', 'CartController@showAll');


Route::get('user/all', 'UserController@index');
Route::post('user', 'UserController@addAdmin');
//Route::post('user/add', 'UserController@addCust');
Route::patch('user/update/{id}', 'UserController@updateAdmin');
Route::get('user/delete/{id}', 'UserController@delete');

Route::post('user/add', 'UserController@add');
