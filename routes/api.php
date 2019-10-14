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

// Recipes Routes
Route::get('/recipes', 'RecipesController@index');
Route::post('/recipes', 'RecipesController@store');
Route::get('/recipes/{recipe}', 'RecipesController@show');
Route::patch('/recipes/{recipe}', 'RecipesController@update');
Route::delete('/recipes/{recipe}', 'RecipesController@destroy');

// Ingredients Routes
Route::get('/ingredients', 'IngredientsController@index');
Route::post('/ingredients', 'IngredientsController@store');
Route::get('/ingredients/{ingredient}', 'IngredientsController@show');
Route::patch('/ingredients/{ingredient}', 'IngredientsController@update');
Route::delete('/ingredients/{ingredient}', 'IngredientsController@destroy');

// Measurements Routes
Route::get('/measurements', 'MeasurementsController@index');
Route::post('/measurements', 'MeasurementsController@store');
Route::get('/measurements/{measurement}', 'MeasurementsController@show');
Route::patch('/measurements/{measurement}', 'MeasurementsController@update');
Route::delete('/measurements/{measurement}', 'MeasurementsController@destroy');

// Users Routes
Route::get('/users', 'UsersController@index');
Route::post('/users', 'UsersController@store');
Route::get('/users/{user}', 'UsersController@show');
Route::patch('/users/{user}', 'UsersController@update');
Route::delete('/users/{user}', 'UsersController@destroy');
