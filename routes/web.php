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

Route::get('customers')
    ->name('customers')
    ->uses('CustomersController@index');

Route::get('customers/{customer}/edit')
    ->name('customers.edit')
    ->uses('CustomersController@edit');


Route::get('users')
    ->name('users')
    ->uses('UsersController@index');


Route::get('posts')
    ->name('posts')
    ->uses('PostsController@index');


Route::get('last-logins')
    ->name('last-logins')
    ->uses('LastLoginController@index');


Route::get('features')
    ->name('features')
    ->uses('FeaturesController@index');