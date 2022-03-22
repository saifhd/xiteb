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
Route::get('/home/{category}',[HomeController::class,'showSubCategories'])->name('home.categories.show');
Route::get('/home/products/{id}',[HomeController::class,'showProduct'])->name('home.product.show');
Route::post('/home/inqueries/{product}', [HomeController::class, 'sendInquery'])->name('home.inqueries.send');
Route::get('/home/{category}/{sub_category}',[HomeController::class,'showProducts'])->name('categories.sub_categories.show');




require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth', 'admin_or_staff']], function(){
    Route::resource('/categories',CategoriesController::class);

    Route::resource('/sub-categories',SubCategoriesController::class);

    Route::resource('/products',ProductsController::class);
});
