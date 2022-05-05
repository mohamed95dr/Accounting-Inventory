<?php

namespace App\Http\Controllers;

use App\Models\companies;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies=companies::all();
        $suppliers=Suppliers::all();
        return view('suppliers',compact('suppliers','companies'));
    }

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
        $validatedData = $request->validate([
            'name' => 'required|unique:suppliers|max:255',
        ],
        [
            'name.required' =>'يرجي ادخال اسم المورد',
            'name.unique' =>'اسم المورد مسجل مسبقا',
            'company_name.required' =>'يرجي ادخال اسم  الشركة',
        ]);
        

            Suppliers::create([

                'name' => $request->name,
                'company_id' => $request->company_id ,
                'phone' => $request->phone ,
            ]);
            session()->flash('Add', 'تم اضافة المورد الجديد بنجاح ');
            return redirect('/suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliers $suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $suppliers)
    {
        //
        $id = $request->id;

        $this->validate($request, [

            'name' => 'required|max:255|unique:suppliers,name,'.$id,
            'company_name' => 'required|max:255|suppliers,company_name,'.$id,
            'phone' => 'required',
        ],[

            'name.required' =>'يرجي ادخال اسم المورد',
            'company_name.required' =>'اسم الشركة مسجل مسبقا',
            'phone.required' =>'يرجي ادخال رقم الهاتف',

        ]);

        $suppliers = Suppliers::find($id);
        $suppliers->update([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'phone' => $request->phone,
        ]);

        session()->flash('edit','تم تعديل بيانات المورد بنجاج');
        return redirect('/suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id=$request->id;
        Suppliers::find($id)->delete();
        session()->flash('delete','تم حذف المورد بنجاح');
        return redirect('/suppliers');

    }
}
