<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stocktaking;
use App\Http\Controllers\SaleInvoiceController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

use App\Http\Controllers\ReceiptDebtController;
use App\Http\Controllers\sale_debt;


use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\SuppliersController;
use App\Http\Resources\Customers;
use App\Models\costomers;
use App\Models\products;
use App\Models\ReceiptDebt;
use App\Models\SaleDebt;

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
    Route::resource('/users', UsersController::class);
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

    Route::resource('Sale_Invoice', SaleInvoiceController::class);

    Route::get('add_invoiceSale', [SaleInvoiceController::class, 'create']);

    Route::get('view_invoiceSale', [SaleInvoiceController::class, 'show']);


    Route::resource('receipt', ReceiptController::class);

    Route::get('add_invoice', [ReceiptController::class, 'create']);

    Route::view('example', 'example');


    // // /customers

    Route::resource('costomers', 'App\Http\Controllers\CostomersController');

    //stocktaking

    Route::resource('stocktaking', stocktaking::class);

    //receipt_debt

    Route::resource('receipt_debt', ReceiptDebtController::class);

    //sale_debt
    Route::resource('sale_debt', sale_debt::class);


    Route::get('debt/{supplier_id}', function ($supplier_id) {

        return $debt_amount = ReceiptDebt::select('cost')->where('id', $supplier_id)->first()->cost;
    });

    Route::get('saleDebt/{customer_id}', function ($customer_id) {

        //  return $sale_debt = SaleDebt::select('cost')->where('id',$customer_id)->first()->cost;
        $sale_debt = SaleDebt::select('cost')->where('id', $customer_id)->first();

        if ($sale_debt != null) {
            return $sale_debt->cost;
        } else {
            return 0;
        }
    });

    Route::get('getProductQuantity/{pid}', function ($pid) {

        return $quantity = products::select('Quantity')->where('id', $pid)->first()->Quantity;
    });

    Route::get('getCustomerType/{cId}', function ($cId) {

        return $type = costomers::select('type')->where('id', $cId)->first()->type;
    });
});
