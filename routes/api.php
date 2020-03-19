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


Route::post('login', 'APIController@login');
Route::post('register', 'APIController@register');
 
Route::group(['middleware' => 'auth.jwt'], function () {

    Route::get('logout', 'APIController@logout');
    Route::get('user', 'APIController@getAuthUser');
 
    Route::group(['prefix' => 'v1'], function(){

        //pizzas
        Route::resource('pizzas', 'PizzaController');
        
        //order 

        
        Route::post('orders/filtter', 'OrderController@filtter');
        Route::get('orders/showByName/{name}', 'OrderController@showByName');
       
        Route::resource('orders', 'OrderController');

    });
});






