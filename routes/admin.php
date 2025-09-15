<?php

use App\Http\Controllers\Admin\PenaltyTypeController;
use App\Http\Controllers\Admin\RecycleBinController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;






Route::name('book.')->group(function () {
    Route::get('book', [BookController::class, 'index'])->name('index');
    Route::get('book/create', [BookController::class, 'create'])->name('create');
    Route::post('book', [BookController::class, 'store'])->name('store');
    Route::get('book/{book}/edit', [BookController::class, 'edit'])->name('edit');
    Route::put('book/{book}', [BookController::class, 'update'])->name('update');
    Route::delete('book/{book}', [BookController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
});

Route::prefix('admin')->name('admin.book.')->group(function () {
    Route::get('book', [BookController::class, 'index'])->name('index');
    Route::get('book/create', [BookController::class, 'create'])->name('create');
    Route::post('book', [BookController::class, 'store'])->name('store');
    Route::get('book/{book}/edit', [BookController::class, 'edit'])->name('edit');
    Route::put('book/{book}', [BookController::class, 'update'])->name('update');
    Route::delete('book/{book}', [BookController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/recycle-bin')->name('admin.recycle-bin.')->group(function () {
    Route::get('/', [RecycleBinController::class, 'index'])->name('index');

    Route::put('/restore/{model}/{id}', [RecycleBinController::class, 'restore'])->name('restore');
    Route::delete('/delete/{model}/{id}', [RecycleBinController::class, 'forceDelete'])->name('forceDelete');
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
});

Route::prefix('admin/penaltytype')->name('admin.penaltytype.')->group(function () {
    Route::get('/', [PenaltyTypeController::class, 'index'])->name('index');
    Route::post('/', [PenaltyTypeController::class, 'store'])->name('store');
    Route::get('/{penaltyType}/edit', [PenaltyTypeController::class, 'edit'])->name('edit');
    Route::put('/{penaltyType}', [PenaltyTypeController::class, 'update'])->name('update');
    Route::delete('/{penaltyType}', [PenaltyTypeController::class, 'destroy'])->name('destroy');
});


Route::middleware(['auth', 'can:view users'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});
