<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::get('/', [UserController::class, 'create'])->name('login');
Route::get('/home', [ItemController::class, 'index'])->middleware('auth');

Route::get('/register', [UserController::class, 'register']);

Route::post('/users', [UserController::class, 'create_user']);
Route::post('/users/logout', [UserController::class, 'logout'])->middleware('auth');
Route::post('/users/login', [UserController::class, 'login']);

Route::post('/home/add', [ItemController::class, 'new'])->middleware('auth');

Route::get('/home/edit/{id}', [ItemController::class, 'editview'])->middleware('auth');
Route::post('/home/edit/{id}', [ItemController::class, 'edit'])->middleware('auth');

Route::get('home/order/{id}', [OrderController::class, 'create'])->middleware('auth');
Route::post('home/order/{id}', [OrderController::class, 'store'])->middleware('auth');
Route::get('home/orders', [OrderController::class, 'index'])->middleware('auth');
Route::get('home/orders/delete/{id}', [OrderController::class, 'delete'])->middleware('auth');
Route::get('home/orders/approve', [OrderController::class, 'approveview'])->middleware('auth');
Route::get('home/orders/approve/{id}', [OrderController::class, 'approve'])->middleware('auth');
Route::get('home/orders/reject/{id}', [OrderController::class, 'reject'])->middleware('auth');






