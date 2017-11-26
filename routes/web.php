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


Route::get('/','SiteController@index');




Route::get('/search/{query}','SearchController@query');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/user/{id}/recipes','RecipeController@userRecipes');

Route::get('/recipe/{id}/edit','RecipeController@edit')->middleware('auth');
Route::post('/recipe/{id}/edit','RecipeController@post_edit')->middleware('auth');

Route::get('/recipe/{id}/{slug}', 'RecipeController@recipe');


Route::get('/user/invite','InviteController@invite')->middleware('auth');
Route::post('/user/invite','InviteController@post_invite')->middleware('auth');




Route::get('/recipe/create','RecipeController@create')->middleware('auth');
Route::post('/recipe/create','RecipeController@post_create')->middleware('auth');

Route::post('/recipe/upload/image','RecipeController@uploadImage')->middleware('auth');

Route::post('/tag/delete','RecipeController@deleteTag')->middleware('auth');
Route::post('/image/delete','RecipeController@deleteImage')->middleware('auth');

Route::post('/refer','SiteController@refer');
Route::get('/refer/{email}/{token}','InviteController@postRefer');
Route::post('/refer/{email}/{token}','InviteController@postReferComplete');



