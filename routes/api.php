
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DigicamApiController;
use App\Http\Controllers\Api\AuthController;

// Route autentikasi yang bisa diakses tanpa token
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route yang wajib menggunakan token Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/digicam', [DigicamApiController::class, 'index']);
    Route::post('/digicam', [DigicamApiController::class, 'store']);
    Route::get('/digicam/{id}', [DigicamApiController::class, 'show']);
    Route::put('/digicam/{id}', [DigicamApiController::class, 'update']);
    Route::delete('/digicam/{id}', [DigicamApiController::class, 'destroy']);
});
