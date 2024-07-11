<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::get('/', [UserController::class, 'create']);
Route::get('/home', [ItemController::class, 'index']);

Route::get('/register', [UserController::class, 'register']);

Route::post('/users', [UserController::class, 'create_user']);
Route::post('/users/logout', [UserController::class, 'logout']);
Route::post('/users/login', [UserController::class, 'login']);

Route::post('/home/add', [ItemController::class, 'new']);

Route::get('/home/edit/{id}', [ItemController::class, 'editview']);
Route::post('/home/edit/{id}', [ItemController::class, 'edit']);

Route::get('home/order/{id}', [OrderController::class, 'create']);
Route::post('home/order/{id}', [OrderController::class, 'store']);
Route::get('home/orders', [OrderController::class, 'index']);
Route::get('home/orders/cancel/{id}', [OrderController::class, 'cancel']);
Route::get('home/orders/delete/{id}', [OrderController::class, 'delete']);




