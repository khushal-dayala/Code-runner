<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\HomeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::post('/execute', [HomeController::class, 'execute'])->name('php-execute');