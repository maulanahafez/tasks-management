<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
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
    return redirect()->route('task.index');
})->name('index');

Route::get('/login', function () {
    return "Hello";
})->name('login');

Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
// Route::get('/tasks/{task:id}', [TaskController::class, 'show'])->name('task.show');
Route::get('/tasks/incomplete', [TaskController::class, 'incomplete'])->name('task.incomplete');
Route::get('/tasks/completed', [TaskController::class, 'completed'])->name('task.completed');
Route::get('/tasks/{task:id}', [TaskController::class, 'edit'])->name('task.edit');
Route::put('/tasks/{task:id}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/tasks/{task:id}', [TaskController::class, 'destroy'])->name('task.destroy');
Route::put('/tasks/{task:id}/status', [TaskController::class, 'status'])->name('task.status');
