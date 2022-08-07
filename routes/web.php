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
use App\Models\Categories;
use App\Models\costomers;
use App\Models\products;
use App\Models\receipt;
use App\Models\receipt_invoice_details;
use App\Models\ReceiptDebt;
use App\Models\SaleDebt;
use Illuminate\Http\Request;

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

        $debt_amount = ReceiptDebt::select('cost')->where('supplier_id', $supplier_id)->first();

        if ($debt_amount != null) {
            return $debt_amount->cost;
        } else {
            return 0;
        }
    });

    Route::get('category/{name}', function ($name) {

        $category_name = Categories::select('cateory_name')->where('cateory_name', $name)->first();
        if ($category_name != null) {
            return true;
        } else {
            return false;
        }
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

    Route::get('invoiceReceipt_view/{id}', function ($id) {

        $receipt_invoice = receipt::where('id', $id)->first();
        $productsReceipt = receipt_invoice_details::where('receipts_id', $id)->first();
        $supplier_id = $receipt_invoice->supplier_id;
        $cost = ReceiptDebt:: select('cost')->where('supplier_id',$supplier_id)->first()->cost;
        // return $cost;
    });

    Route::get('invoiceReceipt_view/{id}', [ReceiptController::class, 'show']);

    Route::get('stocktaking_filter', [stocktaking::class,'show']);

    //

    Route::get('stocktaking_filter_validation', [stocktaking::class,'validation']);



});
