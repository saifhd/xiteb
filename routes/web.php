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

Route::group(['middleware' => ['auth', 'admin_or_staff']], function(){
    Route::resource('/categories',CategoriesController::class);
    
    Route::resource('/sub-categories',SubCategoriesController::class);

    Route::resource('/products',ProductsController::class);
});
