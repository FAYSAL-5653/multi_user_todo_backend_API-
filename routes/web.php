<?php

use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

// Web API Routes
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verifi-otp', [UserController::class, 'VerifyOTPCode']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);

// todo
Route::get('/todo-list', [TodoItemController::class, 'index'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-todo', [TodoItemController::class, 'store'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-todo', [TodoItemController::class, 'update'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-todo', [TodoItemController::class, 'destroy'])->middleware([TokenVerificationMiddleware::class]);
