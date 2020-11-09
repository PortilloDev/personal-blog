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

Route::redirect('/', 'blog');

//grupo de rutas para el control de autenticación
/*Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@Login')->name('login');
Route::get('logout', 'Auth\LoginController@Logout')->name('logout');*/
Auth::routes();

//web
Route::get('blog', 'Web\PageController@blog')->name('blog');
Route::get('entrada/{slug}', 'Web\PageController@post')->name('post');
Route::get('category/{slug}', 'Web\PageController@category')->name('category');
Route::get('etiqueta/{slug}', 'Web\PageController@tag')->name('tag');

//admin
Route::resource('tags',       'Admin\TagController');
Route::resource('categories', 'Admin\CategoryController');
Route::resource('posts',      'Admin\PostController');


