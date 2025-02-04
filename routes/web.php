<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Front side routes
// Route::get('/', [HomeController::class, 'index'])->name('front.index');
// Route::post('/execute', [HomeController::class, 'execute'])->name('php-execute');

// // Admin side routes    
// Route::get('/admin1', function () {
//     return view('admin.index');
// });
// Route::resource('/codes', CodeController::class);
// Route::get('codes/{id}/delete', [CodeController::class, 'destroy'])->name('codes.delete');

// Route::resource('/categories', CategoryController::class);
// Route::get('codes/{id}/delete', [CategoryController::class, 'destroy'])->name('codes.delete');

// Route::get('/category-suggestions', [CategoryController::class, 'suggestions'])->name('category.suggestions');

require __DIR__.'/auth.php';
