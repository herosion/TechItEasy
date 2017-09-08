<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', [
    'as' => 'welcome', 'uses' => 'HomeController@welcome'
]);

Route::get('/login', [
    'as' => 'login', 'uses' => 'HomeController@login'
]);

Route::get('index', [
    'as' => 'index', 'uses' => 'HomeController@index'
]);

Route::get('questionnaire/{id}/launch', [
    'as' => 'questionnaire.launch', 'uses' => 'HomeController@launch'
]);


Route::post('valider', 'HomeController@valider');
/*
  |--------------------------------------------------------------------------
  | Authentication Routes
  |--------------------------------------------------------------------------
 */
Route::post('auth/login', 'Auth\AuthController@authenticate');

Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::post('/login', 'HomeController@authenticate');

/*
  |--------------------------------------------------------------------------
  | Reset password 
  |--------------------------------------------------------------------------
 */
Route::get('/password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('email');
Route::post('/sendResetLink', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('valideEmail');

Route::post('/password/reset', 'Auth\ResetPasswordController@showResetForm')->name('reset');

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', [
        'as' => 'dashboard', 'uses' => 'Admin\AdminController@dashboard'
    ]);

    Route::resource('category', 'Admin\CategoryController', ['except' => ['show']]);

    Route::resource('question', 'Admin\QuestionController');
    Route::resource('reponse', 'Admin\ReponseController');
    Route::resource('questionnaire', 'Admin\QuestionnaireController');

    Route::get('questions/questionsBycategories', 'Admin\QuestionnaireController@questionsBycat')->name('questionsBycat');

    Route::post('question/{id}/test', 'Admin\QuestionController@testQuestion');
});

Route::get('democlass', function(){

});