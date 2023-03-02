<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\AdminController;

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

// Homepage is list of links
Route::get('/', [LinkController::class, 'index'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// TODO: use resourceful routing to consolidate this
Route::get('/links', [LinkController::class, 'index'])->middleware(['auth'])->name('link.list');
Route::get('/links/{shortcode}/edit', [LinkController::class, 'edit'])->middleware(['auth'])->name('link.edit');
Route::get('/links/new', [LinkController::class, 'create'])->middleware(['auth'])->name('link.create');
Route::get('/links/{shortcode}/delete', [LinkController::class, 'delete'])->middleware(['auth'])->name('link.delete');
Route::get('/l/{shortcode}', [LinkController::class, 'show'])->name('link.show');

Route::patch('/links/{shortcode}', [LinkController::class, 'update'])->middleware(['auth'])->name('link.update');
Route::post('/links', [LinkController::class, 'store'])->middleware(['auth'])->name('link.store');
Route::delete('/links/{shortcode}', [LinkController::class, 'destroy'])->middleware(['auth'])->name('link.destroy');

Route::middleware(['auth', 'superuser'])->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.show');
    Route::get('/admin/user/{id}', [AdminController::class, 'user_edit'])->name('admin.user');
    Route::get('/admin/code/{id}', [AdminController::class, 'code_edit'])->name('admin.code_edit');
    Route::patch('/admin/code/{id}', [AdminController::class, 'code_update'])->name('admin.code_update');
    Route::get('/admin/code', [AdminController::class, 'code_create'])->name('admin.code_create');
    Route::post('/admin/code', [AdminController::class, 'code_store'])->name('admin.code_store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
