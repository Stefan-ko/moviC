<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MovieController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {
    Route::get('/movies', [MovieController::class, 'index'])->name('admin.movies.index');
    Route::get('/movies/create', [MovieController::class, 'create'])->name('admin.movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('admin.movies.store');
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('admin.movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('admin.movies.destroy');
});

require __DIR__.'/auth.php';
