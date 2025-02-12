<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/testapi', function () {
    return response()->json(['message' => 'passou']);
});

Route::prefix('auth')->group(function () {
    Route::middleware('api')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/{id}', [AuthController::class, 'update']);
    Route::delete('/{id}', [AuthController::class, 'delete']);

    Route::get('/my-profile', [AuthController::class, 'myProfile']);
    Route::post('/my-profile', [AuthController::class, 'updateProfilePicture']);
});
Route::prefix('students')->group(function () {
    Route::get('/{id}/grades', [StudentController::class, 'getGrades']);
    Route::get('/{id}/attendance', [StudentController::class, 'getAttendance']);
    Route::post('/create', [StudentController::class, 'create']);
    Route::put('/{id}', [StudentController::class, 'update']);
});
    Route::post('/password/reset-request', [AuthController::class, 'sendResetEmail']);
    Route::post('/password/reset', [AuthController::class, 'resetPassword']);
});
Route::prefix('user')->group(function () {
    Route::post('/create', [UserController::class, 'create']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/', [UserController::class, 'index']);
});







