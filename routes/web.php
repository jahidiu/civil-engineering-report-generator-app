<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/cc', function () {
    \Artisan::call('storage:link');
    \Artisan::call('optimize:clear');
    return back()->with('success', 'Cache Clear Successfully!');
});


Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/user-profile', [HomeController::class, 'userProfile'])->name('user.profile');
    Route::post('/user-profile', [HomeController::class, 'updateUserProfile'])->name('user.update_profile');
});

Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/user', 'index')->name('user.index');
    Route::post('/user', 'store')->name('user.store');
    Route::get('/user/{user}/edit', 'edit')->name('user.edit');
    Route::put('/user/{user}', 'update')->name('user.update');
    Route::delete('/user/{user}', 'destroy')->name('user.destroy');
});
Route::controller(RoleController::class)->middleware('auth')->group(function () {
    Route::get('/role', 'index')->name('role.index');
    Route::post('/role', 'store')->name('role.store');
    Route::get('/role/{role}/edit', 'edit')->name('role.edit');
    Route::put('/role/{role}', 'update')->name('role.update');
    Route::delete('/role/{role}', 'destroy')->name('role.destroy');
    Route::get('/role-permission/{role}', 'rolePermission')->name('role.permission');
    Route::post('/role-assign-permission', 'roleAssignPermission')->name('role.assign.permission');
    Route::get('/role-list', 'get_for_select')->name('role.list');
});
