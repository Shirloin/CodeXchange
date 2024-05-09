<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('pages.home-page');
});
Route::get('/topic', [TopicController::class, 'index']);
Route::get('/login', function () {
    return view('pages.auth.login-page');
});
Route::get('/register', function () {
    return view('pages.auth.register-page');
});

Route::get('/profile/{id}', [UserController::class, 'index']);

Route::get('/debug', function () {
    return view('pages.debug-page');
});


Route::post('/register', [AuthController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
