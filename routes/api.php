<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('food', \App\Http\Controllers\FoodController::class)
    ->middleware(['auth:sanctum']);

Route::apiResource('symptom', \App\Http\Controllers\SymptomController::class)
    ->middleware(['auth:sanctum']);