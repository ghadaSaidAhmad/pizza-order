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


Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
 
Route::group(['middleware' => 'auth.jwt'], function () {

    Route::get('logout', 'ApiController@logout');
    Route::get('user', 'ApiController@getAuthUser');
 
    Route::group(['prefix' => 'v1'], function(){
            Route::get('pizzas', 'PizzaController@index');
            Route::get('pizzas/{id}', 'PizzaController@show');
            Route::post('pizzas', 'PizzaController@store');
            Route::put('pizzas/{id}', 'PizzaController@update');
            Route::delete('pizzas/{id}', 'PizzaController@destroy');

    });
});






