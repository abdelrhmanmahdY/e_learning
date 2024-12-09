<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/libraries', function () {
    return view('library.index');
})->middleware(['auth', 'verified'])->name('library.index');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get("/books", [BookController::class, 'index'])->name('book.index');
    Route::post("/books", [BookController::class, 'store'])->name('book.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
