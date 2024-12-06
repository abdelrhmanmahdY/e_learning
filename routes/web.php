<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/users', function () {
    return view('user.index');
})->middleware(['auth', 'verified'])->name('user.index');
Route::get('/books', function () {
    return view('book.index');
})->middleware(['auth', 'verified'])->name('book.index');
Route::get('/libraries', function () {
    return view('library.index');
})->middleware(['auth', 'verified'])->name('library.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
