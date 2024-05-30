<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/fetchTasks', [TaskController::class, 'fetchTasks']);
Route::post('/edit/{id}', [TaskController::class, 'edit']);
Route::post('/update/{id}', [TaskController::class, 'update']);
Route::post('/store', [TaskController::class, 'store']);
Route::post('/done/{id}', [TaskController::class, 'done']);
Route::post('/undo/{id}', [TaskController::class, 'undo']);
Route::post('/destroy/{id}', [TaskController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
