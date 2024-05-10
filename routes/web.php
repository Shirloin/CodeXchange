<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Pages\Auth\Login;
use App\Http\Livewire\Pages\Auth\Register;
use App\Http\Livewire\Pages\Home;
use App\Http\Livewire\Pages\Profile;
use App\Http\Livewire\Pages\Topic;
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

Route::get('/', Home::class);
Route::get('/topic', Topic::class);
Route::get('/login', Login::class);
Route::get('/register', Register::class);

Route::get('/profile/{id}', Profile::class);

Route::post('/logout', [AuthController::class, 'logout']);
