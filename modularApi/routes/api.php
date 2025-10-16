<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
//  route non protegees 

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
   
});
Route::get('/users', [UserController::class, 'index']);

// routes protegées 


// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('shorten')->middleware(['verified'])->group(function () {
        // Route::get('/{id}', [::class, 'show']);
       
    });
});

