<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkOSController;

Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/* ROUTE WORKOS */
Route::get('/auth/workos', [WorkOSController::class, 'redirect'])
    ->name('workos.login');

Route::get('/auth/callback', [WorkOSController::class, 'callback'])
    ->name('workos.callback');

Route::middleware('auth')->group(function () {

    Route::get('/todo', [TodoController::class, 'index'])
        ->name('todo');

    Route::post('/todo', [TodoController::class, 'store'])
        ->name('todo.post');

    Route::put('/todo/{id}', [TodoController::class, 'update'])
        ->name('todo.update');

    Route::delete('/todo/{id}', [TodoController::class, 'destroy'])
        ->name('todo.delete');
});

Route::redirect('/', '/todo');