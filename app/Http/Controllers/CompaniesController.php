<?php

namespace App\Http\Controllers;

use App\Models\companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
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
        return view('companies',compact('companies'));

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
            'name' => 'required|unique:companies|max:255',
            'description' => 'required|max:255',
        ],
            [
                'name.required' => 'يرجي ادخال اسم الشركة',
                'name.unique' => 'اسم الشركة مسجل مسبقا',
                'description.required' => 'يرجي ادخال وصف الشركة ',
            ]);

        companies::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        session()->flash('Add', 'تم اضافة الشركة بنجاح ');
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, companies $companies)
    {
        //
        $id = $request->id;
        $this->validate($request, [

            'name' => 'required|max:255|unique:companies,name,'.$id,
            'description' => 'required',
        ],[

            'name.required' =>'يرجي ادخال اسم الشركة',
            'name.unique' =>'اسم الشركة مسجل مسبقا',
            'description.required' =>'يرجي ادخال الوصف',

        ]);

        $companies = companies::find($id);
        $companies->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل بيانات الشركة بنجاج');
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
         $id=$request->id;
         companies::find($id)->delete();
        session()->flash('delete','تم حذف الشركة بنجاح');
        return redirect('/companies');
    }
}
