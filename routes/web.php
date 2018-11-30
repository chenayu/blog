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


Route::middleware(['login'])->group(function(){ 

Route::get('/admin','admin\IndexController@index')->name('admin.index');

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
//ajax是否公开
Route::get('/is_show/{id}','admin\ArticleController@is_show')->name('article.is_show');
//ajax是否置顶
Route::get('/top/{id}','admin\ArticleController@top')->name('article.top');

//分类
Route::get('/category','admin\CategoryController@index')->name('category');
//添加分类
Route::post('/category/insert','admin\CategoryController@insert')->name('category.insert');
// //显示修改类别
// Route::get('/category/edit/{id}','admin\CategoryController@edit')->name('category.edit');
// //分类修改
// Route::post('/category/update/{id}','admin\CategoryController@update')->name('category.update');
//删除分类
Route::get('/category/delete/{id}','admin\CategoryController@delete')->name('category.delete');

//个人中心
Route::get('/personage','admin\PersonageController@index')->name('personage');
//信息
Route::get('/info','admin\InfoController@index')->name('info');
//添加个人
Route::post('/info/insert','admin\InfoController@insert')->name('info.insert');

//标签页
Route::get('/tags','admin\TagsController@index')->name('tags');
//添加标签
Route::post('/tags/insert','admin\TagsController@insert')->name('tags.insert');
//显示修改页
Route::get('/tags/edit','admin\TagsController@edit')->name('tags.edit');
Route::get('/tags/update','admin\TagsController@update')->name('tags.update');
//删除标签
Route::get('/tags/delete','admin\TagsController@delete')->name('tags.delete');



//标签页
Route::get('/tags','admin\TagsController@index')->name('tags');
Route::post('/tags/insert','admin\TagsController@insert')->name('tags.insert');
Route::get('/tags/delete','admin\TagsController@delete')->name('tags.delete');


//专辑
Route::get('/album','admin\AlbumController@index')->name('album.index');
Route::post('/album/uploads','admin\AlbumController@uploads')->name('album.uploads');

//类型
Route::get('/album/img_cat','admin\AlbumController@img_cat')->name('album.img_cat');

// Route::get('/album','home\AlbumController@index')->name('album');



//退出登录
Route::get('/logout','admin\LoginController@logout')->name('logout');

//模拟数据
Route::get('/mock','admin\MockController@blog')->name('mock');
Route::get('/test','TestController@test')->name('test');
});

//后台登录
Route::get('/login','admin\LoginController@login')->name('login');
Route::post('/dologin','admin\LoginController@dologin')->name('dologin');

//主页
Route::get('/','home\IndexController@index')->name('index');
//内容页
Route::get('/content/{id}','home\IndexController@content')->name('content');

//自动部署
Route::get('/deploy',function (){
    exec('git pull');
});