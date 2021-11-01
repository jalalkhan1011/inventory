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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){
    Route::resource('/admin/roles', RoleController::class);
    Route::resource('/admin/users', UserController::class);
    Route::resource('/admin/profiles',ProfileController::class);
    Route::resource('/admin/employees', EmployeeController::class);
    Route::resource('/admin/suppliers', SuppliersController::class);
    Route::resource('/admin/categories', CategoryController::class);
    Route::resource('/admin/brands', BrandController::class);
    Route::resource('/admin/units', UnitController::class);
    Route::resource('/admin/products', ProductController::class);
    Route::resource('/admin/customers', CustomerController::class);
    Route::resource('/admin/productsales',ProductSaleController::class);
    Route::get('/admin/product-details/{id}',[ProductSaleController::class,'productDetails'])->name('productdetails');
});
