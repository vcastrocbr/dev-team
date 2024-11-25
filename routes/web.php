<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;

// Language switch route
Route::get('lang/{locale}', [LanguageController::class, 'setLocale'])->middleware(SetLocale::class)->name('lang.switch');

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard page
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

    // Music routes
    Route::get('/musics', [MusicController::class, 'index'])->name('musics.index'); // List all musics
    Route::get('/musics/create', [MusicController::class, 'create'])->name('musics.create'); // Show create form
    Route::post('/musics', [MusicController::class, 'store'])->name('musics.store'); // Store new music
    Route::get('/musics/{music}/edit', [MusicController::class, 'edit'])->name('musics.edit'); // Show edit form
    Route::put('/musics/{music}', [MusicController::class, 'update'])->name('musics.update'); // Update music
    Route::delete('/musics/{music}', [MusicController::class, 'destroy'])->name('musics.destroy'); // Delete music
    Route::get('/musics/{music}', [MusicController::class, 'show'])->name('musics.show'); // Show single music

});

require __DIR__ . '/auth.php';
