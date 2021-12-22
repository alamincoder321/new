<?php

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

Auth::routes(['register' => false]);

//====================== Pos and Login Route here ========================
Route::get('/pos', [App\Http\Controllers\PosController::class, 'index'])->name('pos');
Route::post('/invoice', [App\Http\Controllers\PosController::class, 'Invoice'])->name('invoice');

//====================== Order and Login Route here ======================
Route::post('/final-invoice', [App\Http\Controllers\OrderController::class, 'FinalInvoice'])->name('order.place');
Route::get('/order-details',[App\Http\Controllers\OrderController::class, 'index'])->name('details');

//====================== Cart and Login Route here ========================
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'store'])->name('addcart');
Route::post('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('updatecart');
Route::get('/cart/destroy/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('destroy');



//====================== Dashboard and Login Route here ===================
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('showForm');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/dashboard/due/{id}', [App\Http\Controllers\HomeController::class, 'dueShow'])->name('due');

//====================== Employee Route here ===============================
Route::resource('/employee', App\Http\Controllers\EmployeeController::class);
Route::get('/employee/active/{id}', [App\Http\Controllers\EmployeeController::class, 'Active'])->name('employee.active');
Route::get('/employee/inactive/{id}', [App\Http\Controllers\EmployeeController::class, 'Inactive'])->name('employee.inactive');

//====================== Job Route here ====================================
Route::resource('/job', App\Http\Controllers\JobController::class);
Route::get('/job/active/{id}', [App\Http\Controllers\JobController::class, 'Active'])->name('job.active');
Route::get('/job/inactive/{id}', [App\Http\Controllers\JobController::class, 'Inactive'])->name('job.inactive');

//====================== Customer Route here ====================================
Route::resource('/customer', App\Http\Controllers\CustomerController::class);
Route::get('/customer/active/{id}', [App\Http\Controllers\CustomerController::class, 'Active'])->name('customer.active');
Route::get('/customer/inactive/{id}', [App\Http\Controllers\CustomerController::class, 'Inactive'])->name('customer.inactive');

//====================== Category Route here ====================================
Route::resource('/category', App\Http\Controllers\CategoryController::class);
Route::get('/category/active/{id}', [App\Http\Controllers\CategoryController::class, 'Active'])->name('category.active');
Route::get('/category/inactive/{id}', [App\Http\Controllers\CategoryController::class, 'Inactive'])->name('category.inactive');

//====================== Product Route here ====================================
Route::resource('/product', App\Http\Controllers\ProductController::class);
Route::get('/product/active/{id}', [App\Http\Controllers\ProductController::class, 'Active'])->name('product.active');
Route::get('/product/inactive/{id}', [App\Http\Controllers\ProductController::class, 'Inactive'])->name('product.inactive');