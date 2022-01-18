<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductSaleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\FileController;


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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('files',FileController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){
    //admin routing start
    Route::group(['prefix' => 'admin'],function(){
        Route::resource('/roles', RoleController::class);
        Route::resource('/users', UserController::class);
        Route::resource('/employees', EmployeeController::class);
        Route::resource('/suppliers', SuppliersController::class);
    });
    //admin routing end

    //Profile routing start
    Route::resource('/profiles',ProfileController::class);
    //Profile routing end

    //Customer routing start
    Route::resource('/customers', CustomerController::class);
    //Customer routing send

    //product setting routing start
    Route::group(['prefix' => 'product-setting'],function (){
        Route::resource('/categories', CategoryController::class);
        Route::resource('/brands', BrandController::class);
        Route::resource('/units', UnitController::class);
    });
    //product setting routing end

    //product routing start
    Route::group(['prefix' => 'product-management'],function (){
        Route::resource('/products', ProductController::class);
        Route::resource('/sales',ProductSaleController::class);
    });
    //product routing end

    //stock routing state
    Route::group(['prefix' => 'stock'],function (){
        Route::get('current-stock',[StockController::class,'index'])->name('currentStock');
    });
    //stock routing end

    //ajax request routing start
    Route::get('/admin/product-details/{id}',[ProductSaleController::class,'productDetails'])->name('productdetails');//this rout user for ajax request for get product details on product sale page
    //ajax request routing end
});
