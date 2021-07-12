<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| web Routes
|--------------------------------------------------------------------------
|
| here is where you can register web Routes for your application. these
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. now create something great!
|
*/
Route::middleware(['auth', 'lang', 'auth.lock'])->group(function () {
    Route::get('/', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::get('users/get/dataTable', [\App\Http\Controllers\UserController::class, 'dataTable'])
        ->name('users.dataTable');

    Route::resource('roles', \App\Http\Controllers\RolePermissionController::class);
    Route::get('roles/get/dataTable', [\App\Http\Controllers\RolePermissionController::class, 'dataTable'])
        ->name('roles.dataTable');

});

Route::get('login/locked', [\App\Http\Controllers\LockScreenController::class, 'locked'])
    ->middleware(['auth', 'lang'])
    ->name('login.locked');
Route::post('login/locked', [\App\Http\Controllers\LockScreenController::class, 'unlock'])->name('login.unlock');

require __dir__.'/auth.php';
