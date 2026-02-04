<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

Route::post('/courses/auth', [LoginController::class, 'login'])->name('orders.login');

Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses', [CourseController::class, 'listCourses'])->name('courses.list');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::get('/courses/{course}', [CourseController::class, 'edit'])->name('courses.edit');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
Route::patch('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');

Route::get('/lessons', [LessonController::class, 'listLessons'])->name('lessons.list');
Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::get('/lessons/{lesson}', [LessonController::class, 'edit'])->name('lessons.edit');
Route::patch('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
