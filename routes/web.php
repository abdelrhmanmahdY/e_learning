<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    [HomeController::class, 'index']
)->name('home');

Route::get('/browse', [BrowseController::class, 'index'])->name('browse.index');
Route::get('/browse/{id}', [BrowseController::class, 'show'])->name('browse.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pdf', function (Request $request) {
    $pdf = decrypt($request->pdf_url);
    return view('book.pdf', compact('pdf'));
})->middleware(['auth', 'verified'])->name('pdf.index');



Route::middleware(['auth', 'verified'])->group(function () {

    Route::post('/users', [UserController::class, 'index'])->name('user.index');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::post('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/{user}', [UserController::class, 'addPenalty'])->name('user.addPenalty');
    Route::get("/books", [BookController::class, 'index'])->name('book.index');
    Route::post("/books", [BookController::class, 'store'])->name('book.store');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('book.update');
    Route::post('/books/{book}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::post('/browse', [BrowseController::class, 'store'])->name('browse.store');
});
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('users', UserController::class)->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::resource('user', UserController::class);
});





Gate::define('isAdmin', function ($user) {
    return $user->hasRole('admin');
});

require __DIR__ . '/auth.php';
