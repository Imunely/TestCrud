<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [BookController::class, 'public']);




Route::group(['prefix' => 'admin'], function () {
    /**
     * Book CRUD
     */
    Route::get('/books', [BookController::class, 'index'])->name('books');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/create', [BookController::class, 'store'])->name('book.store');
    Route::get('/{book}/book/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/{book}/book/update', [BookController::class, 'update'])->name('book.update');
    Route::delete('/{book}/book/delete', [BookController::class, 'delete'])->name('book.delete');

    /**
     * Author CRUD
     */
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors');
    Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/author/create', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/{author}/author/edit', [AuthorController::class, 'edit'])->name('author.edit');
    Route::put('/{author}/author/update', [AuthorController::class, 'update'])->name('author.update');
    Route::delete('/{author}/author/delete', [AuthorController::class, 'delete'])->name('author.delete');
});
