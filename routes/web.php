<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

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

Route::get('/links', [LinkController::class, 'index'])->middleware(['auth'])->name('link.list');
Route::get('/links/{shortcode}/edit', [LinkController::class, 'edit'])->middleware(['auth'])->name('link.edit');
Route::get('/links/new', [LinkController::class, 'create'])->middleware(['auth'])->name('link.create');
Route::get('/links/{shortcode}/delete', [LinkController::class, 'delete'])->middleware(['auth'])->name('link.delete');
Route::get('/l/{shortcode}', [LinkController::class, 'show'])->name('link.show');

Route::patch('/links/{shortcode}', [LinkController::class, 'update'])->middleware(['auth'])->name('link.update');
Route::post('/links', [LinkController::class, 'store'])->middleware(['auth'])->name('link.store');
Route::delete('/links/{shortcode}', [LinkController::class, 'destroy'])->middleware(['auth'])->name('link.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
