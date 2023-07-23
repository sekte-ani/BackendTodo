<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::middleware(['auth:sanctum'])->group(function () {
    // Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    Route::get('/notes', [NoteController::class, 'index']);
    Route::get('/notes/{id}', [NoteController::class, 'show'])->middleware('user.note');
    Route::post('/notes', [NoteController::class, 'store']);
    Route::patch('/notes/{id}', [NoteController::class, 'update'])->middleware('user.note');
    Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->middleware('user.note');
});

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/register', [AuthController::class, 'registration'])->middleware('guest');
