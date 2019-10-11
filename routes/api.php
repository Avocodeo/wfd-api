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

Route::get('/status', 'ApplicationStatusController@show')->name('status');


// Ingredients Routes
Route::get('/ingredients', 'IngredientsController@index');
Route::post('/ingredients', 'IngredientsController@store');
Route::get('/ingredients/{ingredient}', 'IngredientsController@show');
Route::patch('/ingredients/{ingredient}', 'IngredientsController@update');
Route::delete('/ingredients/{ingredient}', 'IngredientsController@destroy');