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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','admin\indexController@index')->name('admin.index');

//文章列表
Route::get('/article','admin\ArticleController@index')->name('article');
//添加文章
Route::post('/article/insert','admin\ArticleController@insert')->name('article.insert');
//显示修改文章
Route::get('/article/edit/{id}','admin\ArticleController@edit')->name('article.edit');
//处理文章修改
Route::post('/article/update/{id}','admin\ArticleController@update')->name('article.update');
//删除文章
Route::get('/article/delete/{id}','admin\ArticleController@delete')->name('article.delete');
//
Route::get('/is_show/{id}','admin\ArticleController@is_show')->name('article.is_show');

//分类
Route::get('/category','admin\CategoryController@index')->name('category');
//添加分类
Route::post('/category/insert','admin\CategoryController@insert')->name('category.insert');
// //显示修改类别
// Route::get('/category/edit/{id}','admin\CategoryController@edit')->name('category.edit');
// //分类修改
// Route::post('/category/update/{id}','admin\CategoryController@update')->name('category.update');
// //删除分类
// Route::get('/category/delete/{id}','admin\CategoryController@delete')->name('category.delete');

//模拟数据
Route::get('/mock','admin\MockController@blog')->name('mock');
Route::get('/test','TestController@test')->name('test');