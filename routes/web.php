<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Place\IndexPlaceController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\Admin\Category\CategoryIndexController;
use App\Http\Controllers\Admin\Category\CategoryShowController;
use App\Http\Controllers\Admin\Category\CategoryStoreController;
use App\Http\Controllers\Admin\Category\CategoryUpdateADController;
use App\Http\Controllers\Admin\Category\CategoryEditADController;
use App\Http\Controllers\Admin\Category\CategoryDestroyController;
use App\Http\Controllers\Admin\Category\CategoryCreateController;

// ====== Публичные маршруты ======
Route::get('/', IndexPlaceController::class)->name('place.index');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/dictionary', [CategoriesController::class, 'dictionaryAll'])->name('dictionary.index');

Route::get('/place/{category}/dictionary', [CategoriesController::class, 'dictionary'])->name('place.dictionary');
Route::get('/place/{category}', [CategoriesController::class, 'show'])->name('place.show');

Route::post('/place/card/{card}/progress', [CategoriesController::class, 'updateProgress'])
    ->middleware('auth')
    ->name('place.progress.update');

// ====== Авторизация ======
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ====== Карточки ======
Route::post('/admin/cards/store', [CardController::class, 'store'])->name('admin.card.store');

// ====== Админка ======
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    Route::get('/category', CategoryIndexController::class)->name('category.index');
    Route::get('/category/create', CategoryCreateController::class)->name('category.create');
    Route::post('/category', CategoryStoreController::class)->name('category.store');
    Route::get('/category/{category}/show', CategoryShowController::class)->name('category.show');
    Route::get('/category/{category}/edit', CategoryEditADController::class)->name('category.edit');
    Route::patch('/category/{category}', CategoryUpdateADController::class)->name('category.update');
    Route::delete('/category/{category}', CategoryDestroyController::class)->name('category.destroy');

});