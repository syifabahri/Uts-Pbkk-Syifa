<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengarangBukuController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user', UserController::class);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('data-buku', BukuController::class);
    Route::apiResource('data-pengarang', PengarangController::class);
    Route::apiResource('pengarang-buku', PengarangBukuController::class);
    Route::apiResource('data-peminjaman', PeminjamanController::class);
});