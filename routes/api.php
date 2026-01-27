<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class,'index']);
Route::post('/add/user', [UserController::class,'store']);
Route::put('/update/user', [UserController::class,'update']);
Route::get('/show/user', [UserController::class,'show']);
