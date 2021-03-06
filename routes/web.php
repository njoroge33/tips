<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SubscribeController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreviousController;

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
//     return view('home');
// })->name('home');

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/tips',[TipController::class, 'index'])->name('tips');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/subscribe', [SubscribeController::class, 'index'])->name('subscribe');
Route::post('/subscribe', [SubscribeController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/previous_prediction',[PreviousController::class, 'index'])->name('previous');

Route::get('/how', function () {
    return view('how');
})->name('how');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');
