<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::resource('userAjax', UserController::class)->middleware('auth');
Route::resource('loginAjax', LoginController::class)->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.action')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.action')->middleware('auth');

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard')->middleware('auth');

Route::get('/user', function () {
    return view('user.index');
})->name('user')->middleware('auth');
