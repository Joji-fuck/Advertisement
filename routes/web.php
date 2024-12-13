<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AdvertisementController::class, 'index']) -> name('home');

Route::get('/categories/{id}', [\App\Http\Controllers\AdvertisementController::class, 'category']) -> name('home.category');

Route::get('/register', [\App\Http\Controllers\AuthController::class, 'create']) -> name('register.create');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'store']) -> name('register.store');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login_redirect']) -> name('login.redirect');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']) -> name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']) -> name('logout');

Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile']) -> name('profile') -> middleware('is_auth');

Route::post('/profile', [\App\Http\Controllers\UserController::class, 'update_avatar']) -> name('update.avatar');

Route::get('/create', [\App\Http\Controllers\AdvertisementController::class, 'form']) -> name('adv.form') -> middleware('is_auth');
Route::post('/create', [\App\Http\Controllers\AdvertisementController::class, 'create']) -> name('adv.create');
Route::get('/create/{id}/delete', [\App\Http\Controllers\AdvertisementController::class, 'destroy']) -> name('adv.destroy');

Route::get('/admin', [\App\Http\Controllers\AdminLogController::class, 'index']) -> name('admin') ->middleware('auth','is_admin:admin');
Route::get('/admin/{id}/publish', [\App\Http\Controllers\AdminLogController::class, 'create']) -> name('admin.create');
Route::get('/admin/{id}/delete', [\App\Http\Controllers\AdminLogController::class, 'destroy']) -> name('admin.destroy');
Route::get('/admin/{user}/ban', [\App\Http\Controllers\AdminLogController::class, 'banned']) -> name('admin.banned');
Route::get('/admin/{user}/unban', [\App\Http\Controllers\AdminLogController::class, 'unbanned']) -> name('admin.unbanned');
