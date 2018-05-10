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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::resources([
    'categories' => 'CategoryController',
    'posts' => 'PostController',
]);

Route::get('/contact','HomeController@contact')->name('contact');
Route::post('/sendMail', 'HomeController@send_mail')->name('send_mail');