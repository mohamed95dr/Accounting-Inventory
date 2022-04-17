<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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
    Route::get('/home', [HomeController::class, 'index'])->name('home');

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

Route::get('/{page}',[AdminController::class,'index']);

//test from omran