<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\products;
use App\Models\receipt;
use App\Models\receipt_invoice_details;
use App\Models\ReceiptDebt;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $suppliers = Suppliers::all();
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

        $suppliers = Suppliers::select('id', 'name')->get();
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
        // $countt=count($request->all());

        //  return  $request;
        $ReceptInvoice_id = Receipt::create([
            'supplier_id' => $request->supplier_name,
            'user_id' => (Auth::user()->id),
            'invoice_date' => $request->invoice_date,
            'remainder_debt' => $request->Discount,
            'amount_paid' => $request->paid_value,
            'total_price' => $request->Total_Amount
        ])->id;

        if ($request->Discount > 0) {

            $receipt_dept_id = ReceiptDebt::create([

                'supplier_id' => $request->supplier_name,
                'invoice_date' => $request->invoice_date,
                'cost' => $request->Discount,
            ])->id;
        }



        $i = 1;
        while (true) {

            $pid = 'pid' . (string)$i;
            $pname = 'pname' . (string)$i;
            $category = 'category' . (string)$i;
            $Purchasing_price = 'Purchasing_price' . (string)$i;
            $Wholesale_price = 'Wholesale_price' . (string)$i;
            $retail_price = 'retail_price' . (string)$i;
            $quentity = 'quentity' . (string)$i;
            $Purchasing_date = 'Purchasing_date' . (string)$i;
            $Expiry_date = 'Expiry_date' . (string)$i;

            // if ($request->has($pname)) {

            $id = $request->$pid;

        //    return  $details= receipt_invoice_details::create([

        //         'product_id' => $request->$pid,
        //         'receiptDebt_id' => $receipt_dept_id,
        //         'receipts_id' => $ReceptInvoice_id,
        //         'quantity' => $request->$quentity,
        //         'invoice_date' => $request->invoice_date,
        //         'Pruchasing_price' => $request->$Purchasing_price,
        //         'Wholesale_price' => $request->$Wholesale_price,
        //         'retail_price' => $request->$retail_price,

        //     ]);

            if ($product_id = products::find($id)) {
                
                $quentity_DB = products::select('Quantity')->where('id', $request->$pid)->first();
                $quentity_p = $request->$quentity;
                $quentity_new = $quentity_DB->Quantity + $quentity_p;

                $product_id->update([
                    'Purchasing_price' => $request->$Purchasing_price,
                    'Wholesale_price' => $request->$Wholesale_price,
                    'retail_price' => $request->$retail_price,
                    'Quantity' => $quentity_new,
                    'date_of_supply' => $request->$Purchasing_date,
                    'Expiry_date' => $request->$Expiry_date

                ]);
            } else {
                products::create([
                    'id' => $request->$pid,
                    'product_name' => $request->$pname,
                    'category_id' => Categories::select('id')->where('cateory_name', $request->$category)->first()->id,
                    'Purchasing_price' => $request->$Purchasing_price,
                    'Wholesale_price' => $request->$Wholesale_price,
                    'retail_price'  => $request->$retail_price,
                    'Quantity' => $request->$quentity,
                    'date_of_supply' => $request->$Purchasing_date,
                    'Expiry_date' => $request->$Expiry_date

                ]);
            }
            // } else {
            //     break;
            // }
            $i++;
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
        return view('view_invoice');
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
