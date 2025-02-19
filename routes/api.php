<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
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

    Route::prefix('teacher')->group(function () {
        Route::post('/create', [TeacherController::class, 'create']);
        Route::put('/{id}', [TeacherController::class, 'update']);
        Route::delete('/{id}', [TeacherController::class, 'delete']);
    });

    Route::prefix('grades')->group(function () {
        Route::post('/create', [GradeController::class, 'create']);
        Route::post('/add', [GradeController::class, 'addClass']);
        Route::put('/{id}', [GradeController::class, 'update']);
    });

    Route::prefix('classes')->group(function () {
        Route::post('/create', [ClassController::class, 'createClass']);
        Route::post('/add', [ClassController::class, 'addStudent']);
        Route::delete('/remove/{id}', [ClassController::class, 'removeStudent']);

    });

    Route::prefix('subjects')->group(function () {
        Route::post('/create', [SubjectController::class, 'createSubject']);
        Route::post('/add', [SubjectController::class, 'addSubjectToClass']);
        Route::put('/{id}', [SubjectController::class, 'updateSubject']);
        Route::delete('/remove/{id}', [SubjectController::class, 'deleteSubject']);
    });    

    Route::prefix('students')->group(function () {
        Route::post('/create', [StudentController::class, 'create']);
        Route::delete('/{id}', [StudentController::class, 'delete']);
        Route::put('/{id}', [StudentController::class, 'update']);
        // Route::get('/{id}/grades', [StudentController::class, 'getGrades']);
        // Route::get('/{id}/attendance', [StudentController::class, 'getAttendance']);
    });
});
    Route::post('/password/reset-request', [AuthController::class, 'sendResetEmail']);
    Route::post('/password/reset', [AuthController::class, 'resetPassword']);
});
    Route::prefix('user')->group(function () {
        Route::post('/create', [UserController::class, 'create']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::get('/', [UserController::class, 'index']);
});







