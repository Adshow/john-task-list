<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

Route::prefix('tasks')->group(function () {
    Route::get('/', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
    Route::post('/', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{id}', [\App\Http\Controllers\TaskController::class, 'show'])->name('tasks.show');
    Route::put('/{id}', [\App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/{id}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
});

Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
