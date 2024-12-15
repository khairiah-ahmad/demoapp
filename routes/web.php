<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StaffController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('/todo', TaskController::class);
Route::get('/task', [TaskController::class, 'index'])->name('task.index');
Route::post('/task', [TaskController::class, 'store'])->name('task.store');
Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
Route::put('/task/{task}', [TaskController::class, 'update'])->name('task.update');
Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');

//Route::resource('/staff', TaskController::class);
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');
Route::put('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::get('/staff/search', [StaffController::class, 'search'])->name('staff.search');
Route::get('/staff/delete/{id}', [StaffController::class, 'delete'])->name('staff.delete');
