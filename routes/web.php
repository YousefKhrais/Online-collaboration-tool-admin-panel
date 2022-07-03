<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\TeachersController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return Redirect::to('/dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->middleware(['auth'])->name('admin.profile');

Route::prefix('/teacher')->group(function () {
    Route::get('/', [TeachersController::class, 'index'])->middleware(['auth'])->name('teachers');
    Route::post('/store', [TeachersController::class, 'store'])->name('teacher.store');
    Route::get('/view/{id}', [TeachersController::class, 'view']);
    Route::post('/update/{id}', [TeachersController::class, 'update']);
    Route::post('/delete/{id}', [TeachersController::class, 'destroy']);
});

Route::prefix('/course')->group(function () {
    Route::get('/', [CoursesController::class, 'index'])->middleware(['auth'])->name('courses');
    Route::post('/store', [CoursesController::class, 'store'])->name('course.store');
    Route::get('/view/{id}', [CoursesController::class, 'view']);
    Route::post('/enroll/{id}', [CoursesController::class, 'enroll']);
    Route::post('/unenroll/{id}', [CoursesController::class, 'unenroll']);
    Route::post('/update/{id}', [CoursesController::class, 'update']);
    Route::post('/delete/{id}', [CoursesController::class, 'destroy']);
});

Route::prefix('/category')->group(function () {
    Route::get('/', [CategoriesController::class, 'index'])->middleware(['auth'])->name('categories');
    Route::post('/store', [CategoriesController::class, 'store'])->name('category.store');
    Route::get('/view/{id}', [CategoriesController::class, 'view']);
    Route::post('/update/{id}', [CategoriesController::class, 'update']);
    Route::post('/delete/{id}', [CategoriesController::class, 'destroy']);
});

Route::prefix('/student')->group(function () {
    Route::get('/', [StudentsController::class, 'index'])->middleware(['auth'])->name('students');
    Route::post('/store', [StudentsController::class, 'store'])->name('student.store');
    Route::get('/view/{id}', [StudentsController::class, 'view']);
    Route::post('/update/{id}', [StudentsController::class, 'update']);
    Route::post('/delete/{id}', [StudentsController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
