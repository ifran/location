<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\UserController;
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
Route::get('/login', [LoginController::class, 'index'])->name("login");
Route::post('logar', [LoginController::class, 'logar']);

Route::get('/register', [UserController::class, 'form']);
Route::post('/register', [UserController::class, 'register']);

Route::middleware('user')->group(function () {
    Route::get('/register-location', [LocationController::class, 'index']);
    Route::post('/register-location', [LocationController::class, 'save']);

    Route::get('/home', [HomeController::class, 'index']);
});
