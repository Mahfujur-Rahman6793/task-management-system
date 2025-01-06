<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::get('/get_task', [TaskManagementController::class, 'index']);
Route::post('/post_task', [TaskManagementController::class, 'store']);
// Route::middleware('auth:sanctum')->post('/post_task', [TaskManagementController::class, 'store']);
Route::get('/single_task/{id}', [TaskManagementController::class, 'show']);
Route::put('/update_task/{task}', [TaskManagementController::class, 'update']);
Route::delete('/delete_task/{id}', [TaskManagementController::class, 'destroy']);


