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

Route::get('/dashboard',  [App\Http\Controllers\MainController::class, 'main'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::delete('/users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.destroy');
Route::patch('/admin/{user}', [App\Http\Controllers\AdminController::class, 'approve'])->name('users.approve');
Route::post('/admin/{user}', [App\Http\Controllers\AdminController::class, 'reject'])->name('users.reject');
Route::post('/admin-notification', [App\Http\Controllers\AdminController::class, 'addNotification']);
Route::get('/admin-notification/{id}', [App\Http\Controllers\AdminController::class, 'showNotification'])->name('notification.edit');
Route::put('/admin-notification/{id}/update', [App\Http\Controllers\AdminController::class, 'updateNotification']);
Route::delete('/admin-notification/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteNotification']);

//courses
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
Route::get('/course/{id}/{level}/{times_helped}/results', [App\Http\Controllers\CourseController::class, 'results']);
Route::get('/course/{id}/attendants', [App\Http\Controllers\CourseController::class, 'showAttendants']);
Route::post('/course/{id}/create-test', [App\Http\Controllers\CourseController::class, 'storeTest']);
Route::post('/course-content/{id}', [App\Http\Controllers\CourseController::class, 'storeContent']);
Route::post('/course/{id}/{level}/test', [App\Http\Controllers\CourseController::class, 'endTest']);
Route::get('/course/{id}/{userId}/r', [App\Http\Controllers\CourseController::class, 'showUserResults']);


Route::get('/get-correct-answers/{questionId}', [App\Http\Controllers\AnswerController::class, 'getCorrectAnswerIndices']);

Route::post('/course/{course}/enroll', [App\Http\Controllers\CourseController::class, 'enroll'])->name('course.enroll');
Route::post('/course/{course}/unenroll', [App\Http\Controllers\CourseController::class, 'unenroll'])->name('course.unenroll');
require __DIR__.'/auth.php';
