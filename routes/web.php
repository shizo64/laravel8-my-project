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

// Публичные маршруты
Route::get('/', IndexPlaceController::class)->name('place.index');
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/dictionary', [CategoriesController::class, 'dictionaryAll'])->name('dictionary.index');

Route::get('/place/{category}/dictionary', [CategoriesController::class, 'dictionary'])->name('place.dictionary');
Route::get('/place/{category}', [CategoriesController::class, 'show'])->name('place.show');

Route::post('/place/card/{card}/progress', [CategoriesController::class, 'updateProgress'])
    ->middleware('auth')
    ->name('place.progress.update');

// Авторизация
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//  Админка
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    Route::get('/category', CategoryIndexController::class)->name('category.index');
    Route::get('/category/create', CategoryCreateController::class)->name('category.create');
    Route::post('/category', CategoryStoreController::class)->name('category.store');
    Route::get('/category/{category}/show', CategoryShowController::class)->name('category.show');
    Route::get('/category/{category}/edit', CategoryEditADController::class)->name('category.edit');
    Route::patch('/category/{category}', CategoryUpdateADController::class)->name('category.update');
    Route::delete('/category/{category}', CategoryDestroyController::class)->name('category.destroy');

    // ====== Админ: карточки ======
    Route::get('/cards', [\App\Http\Controllers\CardController::class, 'adminIndex'])->name('card.index');
    Route::get('/cards/create', [\App\Http\Controllers\CardController::class, 'create'])->name('card.create');
    Route::post('/cards', [\App\Http\Controllers\CardController::class, 'store'])->name('card.store');
    Route::get('/cards/{card}/edit', [\App\Http\Controllers\CardController::class, 'edit'])->name('card.edit');
    Route::patch('/cards/{card}', [\App\Http\Controllers\CardController::class, 'update'])->name('card.update');
    Route::delete('/cards/{card}', [\App\Http\Controllers\CardController::class, 'destroy'])->name('card.destroy');
});