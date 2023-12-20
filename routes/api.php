<?php

use App\Http\Controllers\Api\User\Authcontroller;
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

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::controller(Authcontroller::class)
            ->prefix('auth')
            ->group(function () {
                Route::post("/login", 'login');
                Route::post("/register", 'register');
                Route::post("/logut", 'logout');
                Route::post("/change_password", 'changePassword');
            });

    });
