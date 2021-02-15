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
    Route::get('/c_index', 'CategoryController@index')->name('c_index');
    Route::get('/addcategory', 'CategoryController@create')->name('addcategory');
    Route::post('/addcategory', 'CategoryController@store')->name('addcategory');
    Route::get('/edit/{id}', 'CategoryController@edit')->name('update');
    Route::post('/update/{id}', 'CategoryController@update')->name('updateform');
    Route::get('/delete/{id}', 'CategoryController@destroy')->name('delete');
    Route::get('/search_val', 'CategoryController@catSearch');

    Route::get('/addproduct', 'ProductController@create')->name('addproduct');
    Route::post('/addproduct', 'ProductController@store')->name('addproduct');
    Route::get('/productindex', 'ProductController@index')->name('productindex');
    Route::get('/editPro/{id}', 'ProductController@edit')->name('update');
    Route::post('/updateform/{id}', 'ProductController@update')->name('updateform');
    Route::get('/deletePro/{id}', 'ProductController@destroy')->name('deletePro');
    Route::get('active/{id}/{imgid}','ProductController@setactive')->name('activeimage');
    Route::get('delimage/{imgid}','ProductController@delimage')->name('deleteimage');

});
// Route::group(['prefix' => '', 'middleware' => ['admin']], function () {
//     //categories route
//     Route::get('/category', 'CategoryController@index')->name('Categoryform');
//     Route::post('/addcategory', 'CategoryController@store')->name('addcategory');
//     Route::post('/update/{cid}', 'CategoryController@update')->name('updateform');
//     Route::get('/edit/{cid}', 'CategoryController@edit')->name('update');
//     Route::get('/deleterecords/{cid}', 'CategoryController@destroy');
// });
