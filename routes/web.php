<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

// use App\Http\Controllers\UserController;
// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\SuppliersController;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Redirect;

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


// Route::get('/',function(){
//     return view('auth.register');
// });

Auth::routes();


// // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
    Route::resource('/users',UsersController::class);
    ///


    // /categories
    //return all categories
Route::resource('categories', CategoriesController::class);


    // /companies
    //return all companies
    Route::resource('companies', CompaniesController::class);

    // /suppliers
    //return all suppliers
    Route::resource('/suppliers', SuppliersController::class);

//products
Route::resource('products', ProductsController::class);

//invoices
Route::resource('invoice', InvoicesController::class);

Route::get('add_invoice',[InvoicesController::class,'create']);
    // // /customers

 Route::resource('costomers','App\Http\Controllers\CostomersController');


  });

// Route::get('/{page}',[AdminController::class,'index']);
//test omran 2

