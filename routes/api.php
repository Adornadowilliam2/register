<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// http://localhost:8000/api/register
Route::post("/register", [App\Http\Controllers\AuthController::class,'register']);

Route::post("/login", [App\Http\Controllers\AuthController::class,'login']);

Route::prefix("users")->group(function(){
    //POST: http://localhost:8000/api/users store
    Route::post("/", [App\Http\Controllers\UserController::class, 'store']);

    //GET: http://localhost:8000/api/users  showAll
    Route::get("/", [App\Http\Controllers\UserController::class, 'index']);
});