<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'create']);

Route::get('/home', [ItemController::class, 'index']);

Route::get('/register', [UserController::class, 'register']);

Route::post('/users', [UserController::class, 'create_user']);

Route::post('/users/logout', [UserController::class, 'logout']);

Route::post('/users/login', [UserController::class, 'login']);

Route::post('/home/add', [ItemController::class, 'new']);



