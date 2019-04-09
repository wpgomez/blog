<?php

Route::get('/', 'PagesController@home');

Route::get('home', 'HomeController@index');

Route::group([
    'prefix' => 'admin', 
    'namespace' => 'Admin', 
    'middleware' => 'auth'], 
function(){
    Route::get('posts', 'PostsController@index');
    // demas rutas
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
