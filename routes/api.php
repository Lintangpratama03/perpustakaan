<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\PeminjamanController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute untuk metode POST
Route::post('/endpoint', [DataController::class, 'store'])->name('endpoint.store');

// Rute untuk metode GET (jika diperlukan)
Route::get('/endpoint', [DataController::class, 'index'])->name('endpoint.index');
