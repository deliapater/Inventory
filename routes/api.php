<?php

use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\POSController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
  

});

Route::group([
    'middleware' => 'api',

], function ($router) {
    //Employees
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/store-employee', [EmployeeController::class, 'store'])->name('store-employee');
    Route::get('/delete-employee/{id}', [EmployeeController::class, 'destroy'])->name('delete-employee');
    Route::get('/edit-employee/{id}', [EmployeeController::class, 'show'])->name('edit-employee');
    Route::post('/update-employee/{id}', [EmployeeController::class, 'update'])->name('update-employee');   

    //Suppliers
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::post('/store-supplier', [SupplierController::class, 'store'])->name('store-supplier');
    Route::get('/delete-supplier/{id}', [SupplierController::class, 'destroy'])->name('delete-supplier');
    Route::get('/edit-supplier/{id}', [SupplierController::class, 'show'])->name('edit-supplier');
    Route::post('/update-supplier/{id}', [SupplierController::class, 'update'])->name('update-supplier');   

    //Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/store-category', [CategoryController::class, 'store'])->name('store-category');
    Route::get('/delete-category/{id}', [CategoryController::class, 'destroy'])->name('delete-category');
    Route::get('/edit-category/{id}', [CategoryController::class, 'show'])->name('edit-category');
    Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('update-category');   

    //Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/store-product', [ProductController::class, 'store'])->name('store-product');
    Route::get('/delete-product/{id}', [ProductController::class, 'destroy'])->name('delete-product');
    Route::get('/edit-product/{id}', [ProductController::class, 'show'])->name('edit-product');
    Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('update-product');  

    //Expenses
    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::post('/store-expense', [ExpenseController::class, 'store'])->name('store-expense');
    Route::get('/delete-expense/{id}', [ExpenseController::class, 'destroy'])->name('delete-expense');
    Route::get('/edit-expense/{id}', [ExpenseController::class, 'show'])->name('edit-expense');
    Route::post('/update-expense/{id}', [ExpenseController::class, 'update'])->name('update-expense');  

    //Salaries
    Route::post('/salary/paid/{id}', [SalaryController::class, 'paid']);
    Route::get('/salary', [SalaryController::class, 'allSalaries']);
    Route::get('/salary/view/{id}', [SalaryController::class, 'viewSalary']);
    Route::get('edit/salary/{id}', [SalaryController::class, 'editSalary']);
    Route::post('update/salary/{id}', [SalaryController::class, 'updateSalary']);

    //Stock
    // Route::post('update-stock/{id}', [ProductController::class, 'updateStock']);

    //Customers
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post('/store-customer', [CustomerController::class, 'store'])->name('store-customer');
    Route::get('/delete-customer/{id}', [CustomerController::class, 'destroy'])->name('delete-customer');
    Route::get('/edit-customer/{id}', [CustomerController::class, 'show'])->name('edit-customer');
    Route::post('/update-customer/{id}', [CustomerController::class, 'update'])->name('update-customer'); 
    
    //POS
    Route::get('/get/product/{id}', [POSController::class, 'getProduct']);
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart']);
    Route::get('/cart/products', [CartController::class, 'cartProduct']);
    Route::get('/remove-from-cart/{id}', [CartController::class, 'removeCart']);
    Route::get('/increment/{id}', [CartController::class, 'increment']);
    Route::get('/decrement/{id}', [CartController::class, 'decrement']);
    Route::get('/vats', [CartController::class, 'vat']);
    Route::post('/submit-order', [POSController::class, 'submitOrder']);
    Route::post('/search-order', [POSController::class, 'searchOrderDate']);

    //Order
    Route::get('/orders', [OrderController::class, 'todayOrders']);
    Route::get('/order/details/{id}', [OrderController::class, 'details']);
    Route::get('/order/order-details/{id}', [OrderController::class, 'OrderDetails']);

    //Admin Dashboard  
    Route::get('/today-sell', [POSController::class, 'todaySell']);
    Route::get('/today-income', [POSController::class, 'todayIncome']);
    Route::get('/today-due', [POSController::class, 'todayDue']);
    Route::get('/today-expense', [POSController::class, 'todayExpense']);
    Route::get('/today/out-of-stock', [POSController::class, 'outOfStock']);
      
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
