<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Tasks\TaskController;
use App\Http\Controllers\Users\UserController;
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

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Auth
    Route::get('logout', [AuthController::class, 'logout']);

    // User
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
    });

    // Task
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::post('/', [TaskController::class, 'store']);
        Route::put('/{id}', [TaskController::class, 'update']);
        Route::put('/complete/{id}', [TaskController::class, 'updateCompleted']);
        Route::delete('/{id}', [TaskController::class, 'delete']);
    });
});

Route::get('/auth/{provider}/redirect',[OAuthController::class,'getRedirectUrl']);
Route::get('/auth/{provider}/callback',[OAuthController::class,'callback']);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'store']);

