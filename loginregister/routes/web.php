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

Route::get('/register', 'RegisterController@index')->name('register_page');
Route::post('/register/registerdata', 'RegisterController@userRegister')->name('register_data');
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login/data', 'LoginController@authenticate')->name('logindata');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/categoryindex', 'CategoryController@index')->name('categoryindex');
    Route::get('/category', 'CategoryController@create')->name('category');
    Route::post('/category/add', 'CategoryController@store')->name('addcategory');
    Route::get('/edit/{id}', 'CategoryController@edit')->name('update');
    Route::post('/updateCategory/{id}', 'CategoryController@update')->name('updateCategory');
    Route::get('/delete/{id}', 'CategoryController@destroy')->name('delete');
    Route::get('/search_val', 'CategoryController@catSearch');

    Route::get('/product', 'ProductController@create')->name('product');
    Route::post('/product/add', 'ProductController@store')->name('addproduct');
    Route::get('/productindex', 'ProductController@index')->name('productindex');
    Route::get('/editproduct/{id}', 'ProductController@edit')->name('update');
    Route::post('/updateform/{id}', 'ProductController@update')->name('updateform');
    Route::get('/deleteproduct/{id}', 'ProductController@destroy')->name('deleteproduct');
    Route::get('active/{id}/{imgid}','ProductController@setactive')->name('activeimage');
    Route::get('delimage/{imgid}','ProductController@delimage')->name('deleteimage');
    Route::post('/productsearch','ProductController@show')->name('productsearch');
});