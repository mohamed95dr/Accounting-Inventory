<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\CategoriesController;


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

Route::middleware(['guest:web'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::middleware(['auth:web'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // /users
    // /categories
    // /companies
    // /suppliers
    // /customers
    // /products
    // /invoices
    // /reports
    // /debts
    // /inventory
    // /offers

});
Route::resource('categories', CategoriesController::class);
Route::resource('invoice', InvoicesController::class);
Route::get('/{page}',[AdminController::class,'index']);

//test from omran