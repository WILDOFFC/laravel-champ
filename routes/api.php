<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('school-api')->group(function() {
    Route::post('/registr', [RegisterController::class, 'store']);
    Route::post('/auth', [LoginController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/courses', [CourseController::class, 'index']);
        Route::get('/courses/{course}', [LessonController::class, 'index']);
        Route::post('/courses/{course}/buy', [CourseController::class, 'buyCourse']);
        Route::post('/orders', [OrderController::class, 'getUserCourses']);
        Route::get('/orders/{orders}', [OrderController::class, 'cancel']);
    });
});

