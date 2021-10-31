<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
   // return view('welcome');
//});


// definition des route associés pour affichage du formulaire 
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('user/home', 'HomeController@userHome')->name('user.home')->middleware('is_admin');

// creation de route password forgotten et reset

Route::get('/forget-password', 'ForgotPasswordController@getEmail')->name('getEmail');
Route::post('/forget-password', 'ForgotPasswordController@postEmail')->name('postEmail');

// rest password

Route::get('/reset-password/{token}', 'ResetPasswordController@getPassword');
Route::post('/reset-password', 'ResetPasswordController@updatePassword');

// route de test design parten models
Route::get('/product/list', 'CategoriesController@index')->name('index');
// methode post
Route::post('/product/list', 'CategoriesController@stores')->name('stores');

// enregsitre les produits correspondant à une CategoriesController@index

// route de test design parten models
Route::get('/article', 'ArticleController@index')->name('index');
// reoute post
Route::post('/article', 'ArticleController@store')->name('store');

// afficher des article d'une categories

Route::get('/article/show/{id}', 'ArticleController@show')->name('show');
// reoute post

// gere une jointure pour les informations de la categories et articles.
Route::get('/article/list/{id}', 'ArticleController@list')->name('list');
// reoute post
