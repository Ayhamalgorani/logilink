<?php

use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\User\Authcontroller;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\WorkerController;
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
        Route::post("/user_login", 'userLogin');
        Route::post("/register", 'register');
        Route::post("/logut", 'logout');
        Route::post("/change_password", 'changePassword');
        Route::post('/reset_password', 'resetpassword');
    });

Route::controller(WorkerController::class)
    ->prefix('worker')
    ->group(function () {
        Route::post("/login", 'workerLogin');
        Route::post("/form", 'workerForm');
        Route::get("/orders", 'orders');
    });

Route::middleware(['auth:sanctum'])
    ->group(function () {

        Route::controller(WorkerController::class)
            ->prefix('worker')
            ->group(function () {
                Route::get("/orders", 'orders');
                Route::post("/offers/{id}", 'offers');

            });

        Route::controller(Authcontroller::class)
            ->prefix('auth')
            ->group(function () {
                Route::post("/change_password", 'changePassword');
                Route::post("/logout", 'logout');
                Route::get('/users', 'getUser');
            });

        Route::controller(UserController::class)
            ->prefix('user')
            ->group(function () {
                Route::post('/order/{id}', 'orders');
                Route::get("/offers", 'offers');
                Route::get('/user_profile', 'getUserProfile');
                Route::put('/edit_favorites', 'editFavorite');
                Route::get('/favorites', 'getFavorite');
                Route::delete('/delete_acount', 'deleteAcount');
                Route::put('/update_user_info', 'updateUserInfo');
                Route::post('/rating', 'rating');

            });
    });

Route::controller(AppController::class)
    ->group(function () {
        // Route::post('/worker_profile/{service?}', 'getWorkersByService');
        Route::get('/services', 'getServices');
        Route::get('/settings', 'getSettings');
        Route::post('/contact_us', 'creatMessage');
        Route::post('/upload_file', 'uploadFile');
        Route::post('/worker_file/{id}', 'workerFile');
        Route::get('/notification', 'getNotification');

    });
