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
/*....... FRONTEND ROUTES ..........*/
Route::get('/', 'HomeController@index');













/*........ BACKEND ROUTES ...........*/
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');

/* CATEGORY ROUTES */
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::get('/inactive-category/{category_id}','CategoryController@inactive_category');
Route::get('/active-category/{category_id}','CategoryController@active_category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::post('/update-category/{category_id}','CategoryController@update_category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category');
Route::post('/save-category','CategoryController@save_category');

