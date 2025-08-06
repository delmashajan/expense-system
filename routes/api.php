<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ExpenseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/user/login', [AuthApiController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('expenses', [ExpenseApiController::class, 'index']);
    Route::get('expenses/{expense}', [ExpenseApiController::class, 'show']);
    Route::post('expenses', [ExpenseApiController::class, 'store']);
    Route::post('expenses/{expense}/approve', [ExpenseApiController::class, 'approve']);
    Route::post('expenses/{expense}/reject', [ExpenseApiController::class, 'reject']);
});

require __DIR__.'/auth.php';