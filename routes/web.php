<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\DataController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[DataController::class,'index']);

Route::get('/dashboard', function () {
    return view('layout/app');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts', [BlogPostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [BlogPostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [BlogPostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [BlogPostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [BlogPostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [BlogPostController::class, 'destroy'])->name('posts.destroy');
});

require __DIR__.'/auth.php';
