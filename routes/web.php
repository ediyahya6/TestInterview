<?php

use App\Http\Controllers\Core\DashboardController;
use App\Http\Controllers\Core\MainController;
use App\Http\Controllers\UserSoftDeleteController;
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

// Home routes
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Routes
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')
        ->name('dashboard');
    Route::get('/doc', 'doc')
        ->name('documentation');
    Route::get('/settings', 'settings')
        ->name('settings');
});

// CRUD Routes User
Route::controller(UserSoftDeleteController::class)->group(function () {
    Route::get('/user', 'index')
        ->name('user.index');
    Route::get('/user/create', 'create')
        ->name('user.create');
    Route::post('/user/create', 'store')
        ->name('user.store');
    Route::get('/user/trash', 'trash')
        ->name('user.trash');
    Route::post('/user/{id}', 'update')
        ->name('user.update');
    Route::delete('/user/{id}', 'destroy')
        ->name('user.destroy');
    Route::post('/user/{id}/restore', 'restore')
        ->name('user.restore');
    Route::post('/user/{id}/force-delete', 'forceDelete')
        ->name('user.force-delete');
})->middleware('user','admin');

Route::get('/user-api', function () {
    return view('api.index');
})->name('password.api')->middleware('admin');

// Load another route file
require __DIR__ . '/data/users.php';
require __DIR__ . '/data/activity.php';
