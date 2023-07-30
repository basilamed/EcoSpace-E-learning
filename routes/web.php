<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',  [App\Http\Controllers\MainController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/course/create', [App\Http\Controllers\CourseController::class, 'create']);
Route::post('/course', [App\Http\Controllers\CourseController::class, 'store']);
Route::get('/course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit']);
Route::put('/course-edit/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('course.update');
Route::get('/course/{course}', [App\Http\Controllers\CourseController::class, 'show']);
Route::get('/course-view/{course}', [App\Http\Controllers\CourseController::class, 'showCourse']);
Route::get('/all-courses', [App\Http\Controllers\CourseController::class, 'showAll']);
Route::delete('/course/{id}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('course.destroy');
Route::get('/course-content/{id}/create', [App\Http\Controllers\CourseController::class, 'createContent']);
Route::get('/course/{id}/create-test', [App\Http\Controllers\CourseController::class, 'createTest']);
Route::get('/course/{id}/show-test/{level}', [App\Http\Controllers\CourseController::class, 'showTest']);
Route::get('/course/{id}/level', [App\Http\Controllers\CourseController::class, 'showLevel']);
Route::get('/course/{id}/{level}/results', [App\Http\Controllers\CourseController::class, 'results']);
Route::get('/course/{id}/attendants', [App\Http\Controllers\CourseController::class, 'showAttendants']);
Route::post('/course/{id}/create-test', [App\Http\Controllers\CourseController::class, 'storeTest']);
Route::post('/course-content/{id}', [App\Http\Controllers\CourseController::class, 'storeContent']);
Route::post('/course/{id}/{level}/test', [App\Http\Controllers\CourseController::class, 'endTest']);
Route::get('/course/{id}/{userId}/r', [App\Http\Controllers\CourseController::class, 'showUserResults']);

Route::post('/course/{course}/enroll', [App\Http\Controllers\CourseController::class, 'enroll'])->name('course.enroll');
require __DIR__.'/auth.php';
