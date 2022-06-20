<?php

use App\Http\Controllers\api\ReceiptInvoiceController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\SaleDebtController;
use App\Http\Controllers\api\SaleInvoiceController;
use App\Http\Controllers\API\productController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\api\StocktakingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login' , [UserController::class, 'login']);


Route::middleware('auth:api')->group( function () {

    Route::post('register' , [UserController::class, 'register']);

    Route::resource('products', productController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('invoices', SaleInvoiceController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('SaleInvoice', SaleInvoiceController::class);
    Route::resource('SaleDebt', SaleDebtController::class);
    Route::resource('ReceiptInvoice', ReceiptInvoiceController::class);
    Route::resource('stocktaking', StocktakingController::class);

    Route::get('products/show/{id}', [productController::class,'show']);
    Route::resource('products/store', productController::class);
    Route::PATCH('products/update/{id}', [productController::class,'update']);
    Route::DELETE('products/destroy/{id}', [productController::class,'destroy']);


    Route::get('customers/show/{id}', [CustomerController::class,'show']);
    Route::resource('customers/store', CustomerController::class);
    Route::PATCH('customers/update/{id}', [CustomerController::class,'update']);
    Route::DELETE('customers/destroy/{id}', [CustomerController::class,'destroy']);


    Route::get('categories/show/{id}', [CategoryController::class,'show']);
    Route::resource('categories/store', CategoryController::class);
    Route::PATCH('categories/update/{id}', [CategoryController::class,'update']);
    Route::DELETE('categories/destroy/{id}', [CategoryController::class,'destroy']);


    Route::get('companies/show/{id}', [CompanyController::class,'show']);
    Route::resource('companies/store', CompanyController::class);
    Route::PATCH('companies/update/{id}', [CompanyController::class,'update']);
    Route::DELETE('companies/destroy/{id}', [CompanyController::class,'destroy']);

    Route::get('suppliers/show/{id}', [SupplierController::class,'show']);
    Route::resource('suppliers/store', SupplierController::class);
    Route::PATCH('suppliers/update/{id}', [SupplierController::class,'update']);
    Route::DELETE('suppliers/destroy/{id}', [SupplierController::class,'destroy']);

    Route::get('SaleInvoice/show/{id}', [SaleInvoiceController::class,'show']);
    Route::resource('SaleInvoice/store', SaleInvoiceController::class);
    Route::PATCH('SaleInvoice/update/{id}', [SaleInvoiceController::class,'update']);
    Route::DELETE('SaleInvoice/destroy/{id}', [SaleInvoiceController::class,'destroy']);

    Route::get('SaleDebt/show/{id}', [SaleDebtController::class,'show']);
    Route::resource('SaleDebt/store', SaleDebtController::class);
    Route::PATCH('SaleDebt/update/{id}', [SaleDebtController::class,'update']);
    Route::DELETE('SaleDebt/destroy/{id}', [SaleDebtController::class,'destroy']);

    Route::get('ReceiptInvoice/show/{id}', [ReceiptInvoiceController::class,'show']);
    Route::resource('ReceiptInvoice/store', ReceiptInvoiceController::class);
    Route::PATCH('ReceiptInvoice/update/{id}', [ReceiptInvoiceController::class,'update']);
    Route::DELETE('ReceiptInvoice/destroy/{id}', [ReceiptInvoiceController::class,'destroy']);




});
