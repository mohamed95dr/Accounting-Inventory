<?php

namespace App\Http\Controllers;

use App\Models\costomers;
use App\Models\SaleDebt;
use Illuminate\Http\Request;

class sale_debt extends Controller
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
        $customers = costomers::all();
        $sale_debt = SaleDebt::all();
        return view('sale_debt', compact('sale_debt', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $validatedData = $request->validate(
            [
                'customer_id' => 'required|unique:sale_debts|max:255',
            ],
            [
                'customer_id.required' => 'يرجي ادخال اسم الزبون',

                'invoice_date.required' => 'يرجي ادخال التاريخ ',

                'price.required' => 'يرجي ادخال  مبلغ دين الزبون',


            ]
        );
        // return $request;

        SaleDebt::create([
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->invoice_date,
            'price' => $request->price,

        ]);
        session()->flash('Add', 'تم اضافة الدين بنجاح ');
        return redirect('/sale_debt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleDebt  $sale_dabt
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDebt $sale_dabt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleDebt  $sale_debt
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleDebt $sale_dabt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\costomers  $costomers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleDebt $sale_dabt)
    {
        //
        $id = $request->id;

        $this->validate($request, [

            'nmae' => 'required|max:255|unique:SaleDebt,name,' . $id,

        ], [

            'name.required' => 'يرجي ادخال اسم الزبون',
            'name.unique' => 'اسم الزبون مسجل مسبقا',

            'invoice_date.required' => 'يرجي ادخال رقم الزبون',
            'price.required' => 'يرجى ادخال مبلغ دين الزبون  ',
        ]);

        $sale_dabt = SaleDebt::find($id);
        $sale_dabt->update([
            'name' => $request->name,
            'invoice_date' => $request->invoice_date,
            'price' => $request->price,

        ]);
        session()->flash('Add', 'تم تعديل دين الزبون بنجاح ');
        return redirect('/sale_debt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\costomers  $costomers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        SaleDebt::find($id)->delete();
        session()->flash('delete', 'تم حذف دين الزبون بنجاح');
        return redirect('/sale_debt');
    }
}
