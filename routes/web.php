<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
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
        Route::get('forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'forgotPassword'])->name('forgot-password');
        Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'submitLogin'])->name('login::submit');
        Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
        Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register::submit');
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
        Route::get('/new', [\App\Http\Controllers\StoreController::class, 'create'])->name('create');
        Route::post('/new', [\App\Http\Controllers\StoreController::class, 'store'])->name('store');
        Route::get('/{store}', [\App\Http\Controllers\StoreController::class, 'show'])->name('show');
        Route::get('/{store}/edit', [\App\Http\Controllers\StoreController::class, 'edit'])->name('edit');
        Route::put('/{store}/edit', [\App\Http\Controllers\StoreController::class, 'update'])->name('update');
        Route::put('/set-default/{store}', [\App\Http\Controllers\StoreController::class, 'setDefaultStore'])->name('set-default');

        Route::group(['prefix' => '{store}/categories', 'as' => 'categories::'], function() {
            Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('index');
        });

        Route::group(['prefix' => '{store}/income', 'as' => 'income::'], function() {
            Route::get('/', [\App\Http\Controllers\IncomeController::class, 'index'])->name('index');
            Route::get('/csv', [\App\Http\Controllers\IncomeController::class, 'createCsv'])->name('createCsv');
            Route::post('/csv', [\App\Http\Controllers\IncomeController::class, 'storeCsv'])->name('storeCsv');
        });

        Route::group(['prefix' => '{store}/expenditures', 'as' => 'expenditures::'], function() {
            Route::get('/', [\App\Http\Controllers\ExpenditureController::class, 'index'])->name('index');
            Route::get('/csv', [\App\Http\Controllers\ExpenditureController::class, 'createCsv'])->name('createCsv');
            Route::post('/csv', [\App\Http\Controllers\ExpenditureController::class, 'storeCsv'])->name('storeCsv');
        });

        Route::group(['prefix' => '{store}/reports', 'as' => 'reports::'], function() {
            Route::get('/income', [\App\Http\Controllers\ReportController::class, 'incomeStatement'])->name('income');
            Route::get('/stats/expenditure', [\App\Http\Controllers\ReportController::class, 'statExpenditure'])->name('expenditure');
            Route::get('/stats/income', [\App\Http\Controllers\ReportController::class, 'statIncome'])->name('income::stat');
        });
    });

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin::'], function() {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'users', 'as' => 'users::'], function() {
            Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
            Route::get('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
        });

        Route::group(['prefix' => 'stores', 'as' => 'stores::'], function() {
            Route::get('/', [\App\Http\Controllers\Admin\StoreController::class, 'index'])->name('index');
            Route::get('/{store}', [\App\Http\Controllers\Admin\StoreController::class, 'show'])->name('show');
        });

        Route::group(['prefix' => 'settings', 'as' => 'settings::'], function() {
            Route::get('/', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('index');
            Route::put('/', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('update');
        });
    });
});
