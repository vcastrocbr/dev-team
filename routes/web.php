<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;

// Language switch route
Route::get('lang/{locale}', [LanguageController::class, 'setLocale'])->middleware(SetLocale::class)->name('lang.switch');

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard page
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Group authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Task routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); // List all tasks
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create'); // Show create form
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Store new task
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit'); // Show edit form
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update'); // Update task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Delete task
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show'); // Show single task
});

require __DIR__ . '/auth.php';
