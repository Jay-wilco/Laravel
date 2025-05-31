<?php

use App\Http\Controllers\Api\WordController;
use App\Http\Controllers\Api\NameColorController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//thhis gives you api endpoint
Route::apiResource('name-colors', NameColorController::class);
Route::apiResource('words', WordController::class);

Route::get('/words/random/fetch', [WordController::class, 'fetchRandom']);
Route::get('/favorites', [FavoriteController::class, 'index']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
