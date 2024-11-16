<?php

use App\Http\Controllers\Web\LoginController;
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

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/logar', [LoginController::class, 'logar']);

Route::get('/home', 'Web/HomeController@index');
Route::get('/local', 'Web/LocalController@index');
Route::get('/user', 'Web/UserController@index');