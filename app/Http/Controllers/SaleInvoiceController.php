<?php

namespace App\Http\Controllers;

use App\Http\Resources\Customers;
use App\Models\costomers;
use App\Models\products;
use App\Models\Sale_Invoice;
use App\Models\sale_invoice_details;
use App\Models\SaleDebt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sale_invoices = Sale_Invoice::all();
        $customers = costomers::all();
        return view('Sale_Invoice', compact('customers', 'sale_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = costomers::all();

        return view('add_invoiceSale', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request;
        $invoiceSale_id = Sale_Invoice::create([
            'user_id' => (Auth::user()->id),
            'customer_id' => $request->customer_name,
            'invoice_date' => $request->invoice_date,
            'remainder_amount' => $request->Discount,
            'amount_received' => $request->paid_value,
            'total_amount' => $request->total_amount
        ])->id;
        
        
        $Discount = $request->total_amount - $request->paid_value ;

        if ($Discount > 0) {

            SaleDebt::create([

                'customer_id' => $request->customer_name,
                'invoice_date' => $request->invoice_date,
                'cost' => $Discount,
            ]);
        }


        $i = 1;
        while (true) {
            $pid = 'pid' . (string)$i;
            $pname = 'pname' . (string)$i;
            $quentity = 'quentity' . (string)$i;
            $Wholesale_price = 'Wholesale_price' . (string)$i;
            $retail_price = 'retail_price' . (string)$i;

            if ($request->has($Wholesale_price)) {

                $price = $request->$Wholesale_price;
            } else {
                $price = $request->$retail_price;
            }

            if ($request->has($pname)) {

                $id = $request->$pid;
                $quentity_DB = products::select('Quantity')->where('id', $request->$pid)->first();
                $quentity_p = $request->$quentity;
                $quentity_new = $quentity_DB->Quantity - $quentity_p;


                sale_invoice_details::create([
                    'invoice_date' => $request->invoice_date,
                    'sale_invoices_id' => $invoiceSale_id,
                    'product_id' => $request->$pid,
                    'Quantity' => $quentity_p,
                    'unit_price' => $price
                ]);
                
                $product_id = products::find($id);
                $product_id->update([

                    'Quantity' => $quentity_new,

                ]);
            }
             else {
                break;
            }
            $i++;
        }






        session()->flash('Add', 'تم اضافة فاتورة شراء بنجاح ');
        return redirect('/Sale_Invoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale_Invoice  $sale_Invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Sale_Invoice $sale_Invoice)
    {
        $sale_invoices = Sale_Invoice::all();
        $customers = costomers::all();
        return view('view_invoiceSale', compact('customers', 'sale_invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale_Invoice  $sale_Invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale_Invoice $sale_Invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale_Invoice  $sale_Invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale_Invoice $sale_Invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale_Invoice  $sale_Invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale_Invoice $sale_Invoice)
    {
        //
    }
}
