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

Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('home');

Route::group(['namespace' => 'Auth', 'as' => 'auth::'], function() {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
        Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'submitLogin'])->name('login::submit');
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    });
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')
->middleware('auth');

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'stores', 'as' => 'stores::'], function() {
        Route::get('/', [\App\Http\Controllers\StoreController::class, 'index'])->name('index');
        Route::get('/{store}', [\App\Http\Controllers\StoreController::class, 'show'])->name('show');
        Route::put('/set-default/{store}', [\App\Http\Controllers\StoreController::class, 'setDefaultStore'])->name('set-default');
    });
});
