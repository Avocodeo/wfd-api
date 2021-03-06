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

// Auth/Logout routes
Auth::routes();
Route::get('/api/logout', function () {
    Auth::logout();
    return Redirect::to('login');
});

// Landing page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipe-ingredients/{recipe}', 'RecipeIngredientsController@show');

// Home Page After Login
Route::get('/home', 'HomeController@index')->name('home');

// Authenticated routes
Route::group(['middleware' => 'auth'], function () {
        Route::prefix('api')->group(function () {
            Route::get('/user', 'UserController@index');
    //        Route::post('/account', 'UserController@account');
    //        Route::post('/password', 'UserController@password');
        });

    // Catch-all route
    Route::get('/{any}', 'HomeController@index')->where('any', '.*');
});
