<?php

namespace App\Http\Controllers;

use App\Models\receipt;
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
        $suppliers=Suppliers::select('id','name')->get();
        $invoices = receipt::select('id','invoice_date','supplier_id')->get();
        return view('receipt',compact('invoices','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $suppliers=Suppliers::select('name')->get();
        return view('add_invoice',compact('suppliers'));
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
        Receipt::create([
                'supplier_id' => Suppliers::select('id')->where('name',$request->supplier_name)->first()->id ,
                'invoice_date' =>$request->invoice_date,
                'remainder_debt' => $request->Discount,
                'amount_paid' => $request->paid_value,
                'total_price' => $request->Amount_Commission
        ]);

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
