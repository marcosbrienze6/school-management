<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/testapi', function () {
    return response()->json(['message' => 'passou']);
});

Route::prefix('auth')->group(function () {
    Route::middleware('api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/{id}', [AuthController::class, 'update']);
    Route::delete('/{id}', [AuthController::class, 'delete']);
    Route::post('/friend-request', [AuthController::class, 'friendRequest']);
});
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/password/reset-request', [AuthController::class, 'sendResetEmail']);
    Route::post('/password/reset', [AuthController::class, 'resetPassword']);
});
Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'create']);
    Route::get('/', [UserController::class, 'index']);
});






