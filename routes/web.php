<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubCategoriesController;
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

Route::get('/',[HomeController::class,'index'])->name('home');


require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function(){
    Route::get('/categories',[CategoriesController::class , 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

    Route::get('/sub-categories', [SubCategoriesController::class, 'index'])->name('sub-categories.index');
    Route::get('/sub-categories/create', [SubCategoriesController::class, 'create'])->name('sub-categories.create');
    Route::post('/sub-categories', [SubCategoriesController::class, 'store'])->name('sub-categories.store');
    Route::get('/sub-categories/{sub_category}/edit', [SubCategoriesController::class, 'edit'])->name('sub-categories.edit');
    Route::put('/sub-categories/{sub_category}', [SubCategoriesController::class, 'update'])->name('sub-categories.update');
    Route::delete('/sub-categories/{sub_category}', [SubCategoriesController::class, 'destroy'])->name('sub-categories.destroy');

    Route::get('/products', [ProductsController::class,'index'])->name('products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
});
