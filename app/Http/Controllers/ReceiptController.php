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

        $Discount = $request->Total_Amount - $request->paid_value;

        // return $Discount;

        if ($Discount < 0) {

            session()->flash('Add', 'تم ادخال مبلغ من الزبون اكبر  من قيمة الفاتورة يرجى اعادة الادخال ');

            return redirect()->back();
        }


        $receipt_dept_id = ReceiptDebt::create([

            'supplier_id' => $request->supplier_name,
            'invoice_date' => $request->invoice_date,
            'cost' => $Discount,
        ])->id;






        $ReceptInvoice_id = Receipt::create([

            'supplier_id' => $request->supplier_name,
            'receiptDebt_id' => $receipt_dept_id,
            'user_id' => (Auth::user()->id),
            'invoice_date' => $request->invoice_date,
            'remainder_debt' => $request->Discount,
            'amount_paid' => $request->paid_value,
            'total_price' => $request->Total_Amount
        ])->id;





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

            if ($request->has($pname)) {

                $id = $request->$pid;


                $product = products::find($id);

                if ($product != null) {

                    $quentity_DB = products::select('Quantity')->where('id', $request->$pid)->first();
                    $quentity_p = $request->$quentity;
                    $quentity_new = $quentity_DB->Quantity + $quentity_p;

                    $product->update([
                        'Purchasing_price' => $request->$Purchasing_price,
                        'Wholesale_price' => $request->$Wholesale_price,
                        'retail_price' => $request->$retail_price,
                        'Quantity' => $quentity_new,
                        'date_of_supply' => $request->$Purchasing_date,
                        'Expiry_date' => $request->$Expiry_date

                    ]);
                } else {
                    $id = products::create([
                        'id' => $request->$pid,
                        'product_name' => $request->$pname,
                        'category_id' => Categories::select('id')->where('cateory_name', $request->$category)->first()->id,
                        'Purchasing_price' => $request->$Purchasing_price,
                        'Wholesale_price' => $request->$Wholesale_price,
                        'retail_price'  => $request->$retail_price,
                        'Quantity' => $request->$quentity,
                        'date_of_supply' => $request->$Purchasing_date,
                        'Expiry_date' => $request->$Expiry_date

                    ])->id;
                }

                // return $id;

                receipt_invoice_details::create([

                    'product_id' => $id,
                    'receiptDebt_id' => $receipt_dept_id,
                    'receipts_id' => $ReceptInvoice_id,
                    'quantity' => $request->$quentity,
                    'invoice_date' => $request->invoice_date,
                    'Pruchasing_price' => $request->$Purchasing_price,
                    'Wholesale_price' => $request->$Wholesale_price,
                    'retail_price' => $request->$retail_price,

                ]);
            } else {
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
    // public function show(receipt $receipt)
    public function show($id)
    {
        //
       $receipt_invoice = receipt::where('id', $id)->first();
        $productsReceipt = receipt_invoice_details::where('receipts_id', $id)->get();


        foreach ($productsReceipt as $p) {
            $product_id = $p->product_id;
            $category_id = products::select('category_id')->where('id', $product_id)->first()->category_id;
            $category_name = Categories::select('cateory_name')->where('id', $category_id)->first()->cateory_name;
            $p->category_name = $category_name;
            $Expiry_date = products::select('Expiry_date')->where('id', $product_id)->first()->Expiry_date;
            $p->Expiry_date = $Expiry_date;
        }
        // return $productsReceipt;
        $supplier_name = Suppliers::select('name')->where('id', $receipt_invoice->supplier_id)->first()->name;
        $cost = ReceiptDebt::select('cost')->where('supplier_id', $receipt_invoice->supplier_id)->first()->cost;
        return view('invoiceReceipt_view', compact('receipt_invoice', 'productsReceipt', 'supplier_name', 'cost'));
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
