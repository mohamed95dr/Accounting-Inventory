<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\companies;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers=Suppliers::all();
        $companies=companies::all();
        $categories=Categories::all();
        return view('categories',compact('categories','companies','suppliers'));
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
        // return $request;
        $validatedData = $request->validate([
            'cateory_name' => 'required|unique:categories|max:255',
        ],
        [
            'cateory_name.required' =>'يرجي ادخال اسم القسم',
            'cateory_name.unique' =>'اسم القسم مسجل مسبقا',
            'company_id.required' =>'يرجي ادخال اسم الشركة المصنعة',
        ]);

            Categories::create([
                'cateory_name' => $request->cateory_name,
                'company_id' =>$request->company_id,
                'supplier_id' =>$request->supplier_id,
                'description' => $request->description,
                // 'Created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم اضافة القسم بنجاح ');
            return redirect('/categories');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
        //
        $id = $request->id;

        $this->validate($request, [

            'cateory_name' => 'required|max:255|unique:categories,cateory_name,'.$id,
            'description' => 'required',
        ],[

            'cateory_name.required' =>'يرجي ادخال اسم الصنف',
            'cateory_name.unique' =>'اسم الصنف مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);

        $categories = Categories::find($id);
        $categories->update([
            'cateory_name' => $request->cateory_name,
            'company_name' => $request->company_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل الصنف بنجاج');
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        Categories::find($id)->delete();
        session()->flash('delete','تم حذف الصنف بنجاح');
        return redirect('/categories');
    }
}
