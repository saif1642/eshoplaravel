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
Route::get('/dashboard','SuperAdminController@index');
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

/* BRAND ROUTES */
Route::get('/add-brand','ManufactureController@index');
Route::get('/all-brand','ManufactureController@all_brand');
Route::get('/inactive-brand/{manufacture_id}','ManufactureController@inactive_brand');
Route::get('/active-brand/{manufacture_id}','ManufactureController@active_brand');
Route::get('/edit-brand/{manufacture_id}','ManufactureController@edit_brand');
Route::post('/update-brand/{manufacture_id}','ManufactureController@update_brand');
Route::get('/delete-brand/{manufacture_id}','ManufactureController@delete_brand');
Route::post('/save-brand','ManufactureController@save_brand');

/* PRODUCT ROUTES */
Route::get('/add-product','ProductController@index');
Route::post('/save-product','ProductController@save_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/inactive-product/{product_id}','ProductController@inactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::post('/update-product/{product_id}','ProductController@update_product');


/* SLIDER ROUTES */
Route::get('/add-slider','SliderController@add_slider');
Route::post('/save-slider','SliderController@save_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/inactive-slider/{slider_id}','SliderController@inactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');














