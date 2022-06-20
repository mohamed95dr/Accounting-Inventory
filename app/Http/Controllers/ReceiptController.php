<?php

namespace App\Http\Controllers;

use App\Models\Categories;
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

        $suppliers = Suppliers::select('id','name')->get();
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
        Receipt::create([
            'supplier_id' => Suppliers::select('id')->where('name', $request->supplier_name)->first()->id,
            'invoice_date' => $request->invoice_date,
            'remainder_debt' => $request->Discount,
            'amount_paid' => $request->paid_value,
            'total_price' => $request->Total_Amount
        ]);

        if ($request->Discount > 0) {

            ReceiptDebt::create([

                'supplier_id' => Suppliers::select('id')->where('name', $request->supplier_name)->first()->id,
                'invoice_date' => $request->invoice_date,
                'price' => $request->Discount,
            ]);
        }

        //  return $request->has($pname);
        $i=1;
        while (true) {

            $pname = 'pname' . (string)$i;
            $category = 'category' . (string)$i;
            $Purchasing_price = 'Purchasing_price' . (string)$i;
            $Wholesale_price = 'Wholesale_price' . (string)$i;
            $retail_price = 'retail_price' . (string)$i;
            $quentity = 'quentity' . (string)$i;
            $Purchasing_date = 'Purchasing_date' . (string)$i;
            $Expiry_date = 'Expiry_date' . (string)$i;

            if ($request->has($pname)) {

                products::create([

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
            else{
                break;
            }
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
