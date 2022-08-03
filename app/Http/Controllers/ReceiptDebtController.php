<?php

namespace App\Http\Controllers;

use App\Models\ReceiptDebt;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ReceiptDebtController extends Controller
{
    //
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
        $suppliers=Suppliers::all();
        
        $ReceiptDebt=ReceiptDebt::all();
        return view('receipt_debt',compact('ReceiptDebt','suppliers'));
    }
    //

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validatedData = $request->validate([
            'supplier_id' => 'required|unique:receipt_debts|max:255',
        ],
        [
            'supplier_id.required' =>'يرجي ادخال اسم المورد',
            'supplier_id.unique' =>'اسم المورد مسجل مسبقا',
            'cost.required' =>'يرجي ادخال مبلغ الدين ',
        ]);
        

            ReceiptDebt::create([

                'supplier_id' => $request->supplier_id,
                'invoice_date' =>$request->debt_date,
                'cost' => $request->cost

                // 'Created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم اضافة الدين بنجاح ');
            return redirect('/receipt_debt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceiptDebt  $receiptDebt
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiptDebt $receiptDebt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiptDebt  $receiptDebt
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiptDebt $receiptDebt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReceiptDebt  $receiptDebt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceiptDebt $receiptDebt)
    {
        //
        return $id = $request->id;

        $this->validate($request, [

            'supplier_id' => 'required|max:255|unique:ReceiptDebt,supplier_id,'.$id,

            'cost' => 'required',
        ],[

            'supplier_id.required' =>'يرجي ادخال اسم المورد المنتج',
            'invoice_date.required' =>' يرجى ادخال تاريخ الدين  ',
            'cost.required' =>'يرجي ادخال مبلغ الدين',

        ]);

        $receiptDebt = ReceiptDebt::find($id);
        $receiptDebt->update([
            'supplier_id' => $request->supplier_id,
            'invoice_date' => $request->invoice_date,
            'cost' => $request->cost,
        ]);

        session()->flash('edit','تم تعديل الدين بنجاج');
        return redirect('/receipt_debt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiptDebt  $receiptDebt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
        //
        $id = $request->id;
        ReceiptDebt::find($id)->delete();
        session()->flash('delete','تم حذف الدين بنجاح');
        return redirect('/receipt_debt');
    }
}
