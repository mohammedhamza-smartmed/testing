<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/a', [AuthController::class, 'aa'])->middleware('auth:sanctum');

Route::post('/p/{roleId}', [RolePermissionController::class, 'assign'])->middleware('auth:sanctum');

Route::post('/update/{role}', [RolePermissionController::class, 'update'])->middleware('auth:sanctum');
Route::post('/update-user/{user}', [RolePermissionController::class, 'updateUser'])->middleware('auth:sanctum');
