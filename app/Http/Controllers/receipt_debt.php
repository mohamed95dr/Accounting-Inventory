<?php

namespace App\Http\Controllers;

use App\Models\receiptDebt;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class receipt_debt extends Controller
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
        $receipt_debt = receiptDebt::all();
        return view('receipt_debt',compact('receipt_debt','suppliers'));
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
            'name' => 'required|unique:suppliers|max:255',
        ],
        [
            'name.required' =>'يرجي ادخال اسم المورد',
            'name.unique' =>'اسم المورد مسجل مسبقا',
            'date.required' =>'يرجي ادخال تاريخ  الدين',

            'price.required' =>'يرجي ادخال مبلغ  الدين',
        ]);
        

            receiptDebt::create([

                'name' => $request->name,
                'date' => $request->date ,
                'price' => $request->price ,
            ]);
            session()->flash('Add', 'تم اضافة الدين الجديد بنجاح ');
            return redirect('/receipt_debt');
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, receiptDebt $receipt_debt)
    {
        //
        $id = $request->id;

        $this->validate($request, [

            'name' => 'required|max:255|unique:receiptDebt,name,'.$id,
            'date' => 'required'.$id,
            'price' => 'required',
        ],[

            'name.required' =>'يرجي ادخال اسم المورد',
            'date.required' =>'تاريخ الدين مسجل مسبقا',
            'price.required' =>'يرجي ادخال مبلغ الدين',

        ]);

        $receipt_debt = receiptDebt::find($id);
        $receipt_debt->update([
            'name' => $request->name,
            'date' => $request->date,
            'price' => $request->price,
        ]);

        session()->flash('edit','تم تعديل بيانات مبلغ الدين بنجاج');
        return redirect('/receipt_debt');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id=$request->id;
        receiptDebt::find($id)->delete();
        session()->flash('delete','تم حذف الدين بنجاح');
        return redirect('/receipt_debt');

    }


}
