<?php

use App\Http\Controllers\ProfileController;
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

//Auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;


Route::middleware('auth')->prefix('album')->group(function () {
//Album routes
    Route::get('/', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('/', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('/{id}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/{id}', [AlbumController::class, 'update'])->name('albums.update');
    Route::delete('/{id}', [AlbumController::class, 'destroy'])->name('albums.destroy');
    Route::delete('/{id}/destroy-with-pictures', [AlbumController::class, 'destroyWithPictures'])->name('albums.destroy.with-pictures');
    Route::get('/{id}/move-pictures', [AlbumController::class, 'movePictures'])->name('albums.move');
    Route::put('/{id}/confirm-move-pictures', [AlbumController::class, 'confirmMovePictures'])->name('albums.move.confirm');
    
//Pictures routes
    Route::get('/{albumId}/pictures/create', [PictureController::class, 'create'])->name('pictures.create');
    Route::post('/{albumId}/pictures', [PictureController::class, 'store'])->name('pictures.store');
});

