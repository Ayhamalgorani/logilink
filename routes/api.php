<?php

use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\User\Authcontroller;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::controller(Authcontroller::class)
    ->prefix('auth')
    ->group(function () {
        Route::post("/login", 'login');
        Route::post("/register", 'register');
        Route::post("/logut", 'logout');
        Route::post("/change_password", 'changePassword');
        Route::post('/reset_password', 'resetpassword');
    });

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::controller(Authcontroller::class)
            ->prefix('auth')
            ->group(function () {
                Route::post("/change_password", 'changePassword');
                Route::post("/logout", 'logout');
                Route::get('/users', 'getUser');
            });

        Route::controller(UserController::class)
            ->group(function () {
                Route::get('/user_profile', 'getUserProfile');
                Route::post('/worker_profile/{service?}', 'getWorkersByService');
                Route::put('/edit_favorites/{worker}', 'editFavorite');
                Route::get('/favorites', 'getFavorite');
            });

        Route::controller(AppController::class)
            ->group(function () {
                Route::get('/services', 'getServices');
                Route::get('/settings', 'getSettings');
            });
    });
