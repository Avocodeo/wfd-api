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

Route::get('/status', 'API\ApplicationStatusController@show')->name('status');


// Recipes Routes
Route::get('/recipes', 'API\RecipesController@index');
Route::post('/recipes', 'API\RecipesController@store');
Route::get('/recipes/{recipe}', 'API\RecipesController@show');
Route::patch('/recipes/{recipe}', 'API\RecipesController@update');
Route::delete('/recipes/{recipe}', 'API\RecipesController@destroy');

// Ingredients Routes
Route::get('/inventories', 'API\InventoriesController@index');
Route::post('/inventories', 'API\InventoriesController@store');
Route::get('/inventories/{inventory}', 'API\InventoriesController@show');
Route::patch('/inventories/{inventory}', 'API\InventoriesController@update');
Route::delete('/inventories/{inventory}', 'API\InventoriesController@destroy');

// Ingredients Routes
Route::get('/ingredients', 'API\IngredientsController@index');
Route::post('/ingredients', 'API\IngredientsController@store');
Route::get('/ingredients/{ingredient}', 'API\IngredientsController@show');
Route::patch('/ingredients/{ingredient}', 'API\IngredientsController@update');
Route::delete('/ingredients/{ingredient}', 'API\IngredientsController@destroy');

// Measurements Routes
Route::get('/measurements', 'API\MeasurementsController@index');
Route::post('/measurements', 'API\MeasurementsController@store');
Route::get('/measurements/{measurement}', 'API\MeasurementsController@show');
Route::patch('/measurements/{measurement}', 'API\MeasurementsController@update');
Route::delete('/measurements/{measurement}', 'API\MeasurementsController@destroy');

// Measurement Types Routes
Route::get('/measurement_types', 'API\MeasurementTypesController@index');
Route::post('/measurement_types', 'API\MeasurementTypesController@store');
Route::get('/measurement_types/{measurementType}', 'API\MeasurementTypesController@show');
Route::patch('/measurement_types/{measurementType}', 'API\MeasurementTypesController@update');
Route::delete('/measurement_types/{measurementType}', 'API\MeasurementTypesController@destroy');

// Categories Routes
Route::get('/categories', 'API\CategoriesController@index');
Route::post('/categories', 'API\CategoriesController@store');
Route::get('/categories/{category}', 'API\CategoriesController@show');
Route::patch('/categories/{category}', 'API\CategoriesController@update');
Route::delete('/categories/{category}', 'API\CategoriesController@destroy');

// Suppliers Routes
Route::get('/suppliers', 'API\SuppliersController@index');
Route::post('/suppliers', 'API\SuppliersController@store');
Route::get('/suppliers/{supplier}', 'API\SuppliersController@show');
Route::patch('/suppliers/{supplier}', 'API\SuppliersController@update');
Route::delete('/suppliers/{supplier}', 'API\SuppliersController@destroy');

// Users Routes
Route::get('/users', 'API\UsersController@index');
Route::get('/users/{user}', 'API\UsersController@show');
Route::patch('/users/{user}', 'API\UsersController@update');
Route::delete('/users/{user}', 'API\UsersController@destroy');

// Grocery List Routes
Route::get('/groceries', 'API\GroceryListController@index');
Route::post('/groceries', 'API\GroceryListController@store');


// Notifications Routes
Route::get('/notifications', 'API\NotificationsController@index');
Route::post('/notifications', 'API\NotificationsController@store');
// Mail Routes
Route::post('/email', 'API\EmailController@store');
