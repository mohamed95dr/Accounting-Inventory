<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\receipt;
use App\Models\ReceiptDebt;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Receipts;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Suppliers::select('id', 'name')->get();
        $invoices = receipt::select('id', 'invoice_date', 'supplier_id')->get();
        return view('receipt', compact('invoices', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $suppliers = Suppliers::select('name')->get();
        return view('add_invoice', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countt=count($request->all());

         return  $request;
        // Receipt::create([
        //     'supplier_id' => Suppliers::select('id')->where('name', $request->supplier_name)->first()->id,
        //     'invoice_date' => $request->invoice_date,
        //     'remainder_debt' => $request->Discount,
        //     'amount_paid' => $request->paid_value,
        //     'total_price' => $request->Amount_Commission
        // ]);

        // if ($request->Discount > 0) {

        //     ReceiptDebt::create([

        //         'supplier_id' => Suppliers::select('id')->where('name', $request->supplier_name)->first()->id,
        //         'invoice_date' => $request->invoice_date,
        //         'price' => $request->Discount,
        //     ]);
        // }
        $i=1;
        while($countt > 0){
            
            // return $request->pname;
          products::create([
           
            'product_name' => $request->pname.$i,
            'category_id' => $request->category.$i,
            'Purchasing_price' => $request->Purchasing_price.$i,
            'Wholesale_price' => $request->Wholesale_price.$i,
            'retail_price'  => $request->retail_price.$i,
            'Quantity' => $request->quentity.$i,
            'date_of_supply' => $request->Purchasing_date.$i,
            'Expiry_date' => $request->Expiry_date.$i

          ]);
          $i++;
          $countt--;
        }

        session()->flash('Add', 'تم اضافة فاتورة شراء بنجاح ');
        return redirect('/receipt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(receipt $receipt)
    {
        //
    }
}
