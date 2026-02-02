<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/registr', [RegisterController::class, 'store']);
Route::post('/auth', [LoginController::class, 'login']);
Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index']);
Route::get('/courses/{course_id}', [\App\Http\Controllers\LessonController::class, 'index']);
Route::POST('/courses/{course_id}/buy', [\App\Http\Controllers\CourseController::class, 'buyCourse']);
Route::POST('/orders', [\App\Http\Controllers\CourseController::class, 'buyCourse']);

