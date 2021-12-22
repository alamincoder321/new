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

//=========================== Total order route ==========================
Route::get('total/order', [App\Http\Controllers\TotalOrderController::class, 'TotalOrder'])->name('totalorder');
Route::get('today/order', [App\Http\Controllers\TotalOrderController::class, 'TodayOrder'])->name('todayorder');
Route::get('month/order', [App\Http\Controllers\TotalOrderController::class, 'MonthOrder'])->name('monthorder');
//=========================== Total due route ==========================
Route::get('total/due', [App\Http\Controllers\TotalDueController::class, 'TotalDue'])->name('totaldue');

//=========================== Total due route ==========================
Route::get('total/expense', [App\Http\Controllers\TotalDueController::class, 'TotalExpense'])->name('totalexpense');


//====================== Pos and Login Route here ========================
Route::get('/pos', [App\Http\Controllers\PosController::class, 'index'])->name('pos');

//====================== Order and Login Route here ======================
Route::post('/order-place', [App\Http\Controllers\OrderController::class, 'OrderPlace'])->name('order.place');
Route::get('/order-details',[App\Http\Controllers\OrderController::class, 'index'])->name('details');
Route::get('/final-invoice/{id}', [App\Http\Controllers\OrderController::class, 'FinalInvoice'])->name('final.invoice');
Route::get('/order/delete/{id}',[App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');

//====================== Chalan and Login Route here ========================
Route::get('/chalan/details', [App\Http\Controllers\ChalanController::class, 'index'])->name('chalan.index');
Route::get('/chalan/invoice/{id}', [App\Http\Controllers\ChalanController::class, 'invoice'])->name('chalan.invoice');
Route::get('/chalan', [App\Http\Controllers\ChalanController::class, 'create'])->name('chalan.create');
Route::get('/chalan/delete/{id}', [App\Http\Controllers\ChalanController::class, 'destroy'])->name('chalan.destroy');
Route::post('/chalan/save', [App\Http\Controllers\ChalanController::class, 'SaveChalan'])->name('chalan.store');

//====================== Cart and Login Route here ========================
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'store'])->name('addcart');
Route::post('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('updatecart');
Route::get('/cart/destroy/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('destroy');

//====================== Report Route here ========================
Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('index');
Route::get('/report/duelist/{id}', [App\Http\Controllers\ReportController::class, 'duelist'])->name('list.due');
Route::get('/report/pay-duelist', [App\Http\Controllers\ReportController::class, 'paydue'])->name('due.show');
Route::post('/report/due_pay', [App\Http\Controllers\ReportController::class, 'DuePay'])->name('due.pay');
Route::get('/report/due/{id}', [App\Http\Controllers\ReportController::class, 'dueShow'])->name('due');

//====================== Report Route here ========================
Route::resource('/salary', App\Http\Controllers\SalaryController::class);

//====================== Report Route here ========================
Route::resource('/expense', App\Http\Controllers\ExpenseController::class);


//====================== Dashboard and Login Route here ===================
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('showForm');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

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

//====================== Supplier Route here ====================================
Route::resource('/supplier', App\Http\Controllers\SupplierController::class);
Route::get('/supplier/active/{id}', [App\Http\Controllers\SupplierController::class, 'Active'])->name('supplier.active');
Route::get('/supplier/inactive/{id}', [App\Http\Controllers\SupplierController::class, 'Inactive'])->name('supplier.inactive');

//===================== Supplier due pay route here =============================
Route::get('sup/supdue', [App\Http\Controllers\SupplierDueController::class, 'person'])->name('supdue');
Route::get('sup/supedit/{id}', [App\Http\Controllers\SupplierDueController::class, 'edit'])->name('supedit');
Route::post('sup/supedit/{id}', [App\Http\Controllers\SupplierDueController::class, 'update'])->name('supedit.update');
Route::post('sup/duepay', [App\Http\Controllers\SupplierDueController::class, 'SupduePay'])->name('supduepay');
Route::get('sup/duepay/{id}', [App\Http\Controllers\SupplierDueController::class, 'SupPayShow'])->name('suppayshow');


//====================== Category Route here ====================================
Route::resource('/category', App\Http\Controllers\CategoryController::class);
Route::get('/category/active/{id}', [App\Http\Controllers\CategoryController::class, 'Active'])->name('category.active');
Route::get('/category/inactive/{id}', [App\Http\Controllers\CategoryController::class, 'Inactive'])->name('category.inactive');

//====================== Product Route here ====================================
Route::resource('/product', App\Http\Controllers\ProductController::class);
///load/product
Route::get('/load/product/{id}', [App\Http\Controllers\CategoryController::class, 'loadProduct']);

Route::get('/product/active/{id}', [App\Http\Controllers\ProductController::class, 'Active'])->name('product.active');
Route::get('/product/inactive/{id}', [App\Http\Controllers\ProductController::class, 'Inactive'])->name('product.inactive');


//====================== Company Route here ====================================
Route::resource('/setting', App\Http\Controllers\SoftwareController::class);
Route::resource('/company', App\Http\Controllers\CompanyController::class);

