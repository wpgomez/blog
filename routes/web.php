<?php

Route::get('/', 'PagesController@home');
Route::get('blog/{post}', 'PostsController@show')->name('posts.show');

Route::group([
    'prefix' => 'admin', 
    'namespace' => 'Admin', 
    'middleware' => 'auth'], 
function(){
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('posts', 'PostsController@index')->name('admin.posts.index');
    // Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
    Route::post('posts', 'PostsController@store')->name('admin.posts.store');
    Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
    Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');

    Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
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
