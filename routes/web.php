<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
<<<<<<< HEAD
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\CategoriesController;

=======
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
>>>>>>> 5c79d8f23e0efcca9ab0223fa095e207b0324503

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




Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['guest:web'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', function () {
        auth('web')->logout();
        return redirect('/login');
    });

    //return all users
    Route::get('/users', [UserController::class, 'users']);
    //return form to new user 
    Route::get('/new-user', [UserController::class, 'userForm']);
    // save user
    Route::post('/save-user', [UserController::class, 'store']);
    // delete user
    Route::get('/user/{id}', [UserController::class, 'delete']);
    //return form to update user info
    Route::get('/update-user/{id}', [UserController::class, 'updateForm']);
    //save new user info
    Route::get('/update-user/{id}', [UserController::class, 'saveUpdate']);

    // /categories
    //return all categories
    Route::get('/categories', [CategoryController::class, 'users']);
    //return form to new category 
    Route::get('/new-category', [CategoryController::class, 'categoryForm']);
    // save Category
    Route::post('/save-category', [CategoryController::class, 'store']);
    // delete Category
    Route::get('/category/{id}', [CategoryController::class, 'delete']);
    //return form to update Category info
    Route::get('/update-category/{id}', [CategoryController::class, 'updateForm']);
    //save new Category info
    Route::get('/update-category/{id}', [CategoryController::class, 'update']);


    // /companies
    //return all companies
    Route::get('/companies', [CompanyController::class, 'companies']);
    //return form to new company 
    Route::get('/new-company', [CompanyController::class, 'companyForm']);
    // save Category
    Route::post('/save-company', [CompanyController::class, 'store']);
    // delete Category
    Route::get('/company/{id}', [CompanyController::class, 'delete']);
    //return form to update Category info
    Route::get('/update-company/{id}', [CategoryController::class, 'updateForm']);
    //save new Category info
    Route::get('/update-company/{id}', [CategoryController::class, 'update']);


    // /suppliers
    //return all suppliers
    Route::get('/suppliers', [SupplierController::class, 'suppliers']);
    //return form to new Supplier 
    Route::get('/new-supplier', [SupplierController::class, 'companyForm']);
    // save supplier
    Route::post('/save-supplier', [SupplierController::class, 'store']);
    // delete supplier
    Route::get('/supplier/{id}', [SupplierController::class, 'delete']);
    //return form to update supplier info
    Route::get('/update-supplier/{id}', [SupplierController::class, 'updateForm']);
    //save new supplier info
    Route::get('/update-supplier/{id}', [SupplierController::class, 'update']);




    // /customers
    Route::resource('customer','App\Http\Controllers\CustomerController');
    // /products
    Route::resource('product','App\Http\Controllers\ProductController');
    // /invoices
    Route::resource('invoic','App\Http\Controllers\InvoiceController');
    // /reports
    Route::resource('report','App\Http\Controllers\ReportController');
    // /debts
    Route::resource('debt','App\Http\Controllers\DebtController');
    // /inventory
    Route::resource('inventory','App\Http\Controllers\InventoryController');
    // /offers
    Route::resource('offer','App\Http\Controllers\OfferController');

});
<<<<<<< HEAD
Route::resource('categories', CategoriesController::class);
Route::resource('invoice', InvoicesController::class);
Route::get('/{page}',[AdminController::class,'index']);
=======

// Route::get('/{page}',[AdminController::class,'index']);
>>>>>>> 5c79d8f23e0efcca9ab0223fa095e207b0324503

//test from omran