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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Ingredients Routes
Route::get('/ingredients', 'IngredientsController@index');
Route::get('/ingredients/create', 'IngredientsController@create');

// Recipes Routes
Route::get('/recipes', 'RecipesController@index');
Route::get('/recipes/create', 'RecipesController@create');

// Measurements Routes
Route::get('/measurements', 'MeasurementsController@index');
Route::get('/measurement_types', 'MeasurementTypesController@index');

// Users Routes
Route::get('/users', 'UsersController@index');

Route::get('/measurements/create', 'MeasurementsController@create');
Route::get('/users/create', 'UsersController@create');
Route::get('/categories/create', 'CategoriesController@create');
Route::get('/recipes/create', 'RecipesController@create');