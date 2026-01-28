<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class,'index']);
Route::post('/add/user', [UserController::class,'store'])->name('add.user');
Route::put('/update/user', [UserController::class,'update'])->name('update.user');
Route::post('/show/user', [UserController::class,'show'])->name('show.user');
