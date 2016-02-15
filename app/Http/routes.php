<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'Auth\AuthController@getLogin');
    Route::post('/login', 'Auth\AuthController@postLogin');
});

Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('/feedback', 'FeedbackController@index');
    Route::post('/feedback', 'FeedbackController@postFeedback');

    Route::get('/balance', 'BalanceController@index');
    Route::post('/balance', 'BalanceController@postIndex');

    Route::get('/settings', 'SettingsController@index');
    Route::post('/settings', 'SettingsController@postSettings');

    Route::get('/get_product', 'ProductController@getProduct');

    Route::get('/logout', 'MainController@getLogout');
    Route::get('/', 'MainController@index');
});

Route::group(['middleware' => ['auth']], function() {
    Route::post('/post_review', 'ProductController@postReview');
});