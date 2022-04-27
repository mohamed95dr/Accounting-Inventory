<?php

namespace App\Http\Controllers;

use App\Models\costomers;
use Illuminate\Http\Request;

class CostomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $costomers=costomers::all();
        return view('costomers',['costomers'=>$costomers]);
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
        $validatedData = $request->validate([
            'name' => 'required|unique:costomers|max:255',
            'phone' => 'required|unique:costomers|max:255',
        ],
        [
            'name.required' =>'يرجي ادخال اسم الزبون',
            'name.unique' =>'اسم الزبون مسجل مسبقا',

            'phone.required' =>'يرجي ادخال الرقم ',
            'phone.unique' =>' الرقم مسجل مسبقا',
        
            'type.required' =>'يرجي ادخال  نوع الزبون',
            
        
        ]);

             costomers::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'type' => $request->type,

            ]);
            session()->flash('Add', 'تم اضافة الزبون بنجاح ');
            return redirect('/costomers');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\costomers  $costomers
     * @return \Illuminate\Http\Response
     */
    public function show(costomers $costomers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\costomers  $costomers
     * @return \Illuminate\Http\Response
     */
    public function edit(costomers $costomers)
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
    public function update(Request $request, costomers $costomers)
    {
        //
        $id = $request->id;

        $this->validate($request, [

            'nmae' => 'required|max:255|unique:costomers,name,'.$id,
            'phone' => 'required|max:255|unique:costomers,phone,'.$id,

        ],[

            'name.required' =>'يرجي ادخال اسم الزبون',
            'name.unique' =>'اسم الزبون مسجل مسبقا',

            'phone.required' =>'يرجي ادخال رقم الزبون',
            'phone.unique' =>'رقم الزبون مسجل مسبقا',
        ]);

        $costomers = costomers::find($id);
        $costomers->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'type' => $request->type,

        ]);
        session()->flash('Add', 'تم تعديل الزبون بنجاح ');
        return redirect('/costomers');

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
        costomers::find($id)->delete();
        session()->flash('delete','تم حذف الزبون بنجاح');
        return redirect('/costomers');
    }
}
