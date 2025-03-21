<?php
use App\Http\Controllers\TaskController;

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
Route::get('/', 'HomeController@index');
// Route::get('/sample', 'TaskController');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/list', 'TodoListController@index');
Route::resource('tasks', 'TaskController');

Route::get('/sample', 'TaskController@sample');
Route::get('/sample/tasks/{task}/edit', 'TaskController@edit');
// Route::post('/sample', 'TaskController@store');
