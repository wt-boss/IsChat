<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestController2;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [IndexController::class, 'index']); 
Route::get('login', [AuthController::class , 'login']);
Route::post('login', [AuthController::class , 'login_user']);
Route::delete('logout', [AuthController::class , 'logout']);
Route::get('register', [AuthController::class , 'register']);
Route::post('register', [AuthController::class , 'store']);
Route::resource('chat', ChatController::class);



