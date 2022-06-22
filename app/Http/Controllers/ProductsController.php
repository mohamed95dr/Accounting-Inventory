<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
        $categories=Categories::all();
        
        $products=products::all();
        return view('products',compact('categories','products'));
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
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products|max:255',
        ],
        [
            'product_name.required' =>'يرجي ادخال اسم المنتج',
            'product_name.unique' =>'اسم المنتج مسجل مسبقا',
            'cateory_name.required' =>'يرجي ادخال اسم  الصنف',
        ]);
        

            products::create([
                'id'=>$request->product_id,
                'product_name' => $request->product_name,
                'category_id' => $request->category_id ,
                'Purchasing_price'=> $request->Purchasing_price,
                'Wholesale_price'=> $request->Wholesale_price,
                'retail_price'=>$request->retail_price,
                'Quantity'=>$request->Quantity,
                'date_of_supply'=>$request->date_of_supply,
                'Expiry_date'=>$request->Expiry_date,
                'description' => $request->description,

                // 'Created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم اضافة المنتج بنجاح ');
            return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {
        //
        // return $request;
        $id = $request->product_id;

        $this->validate($request, [

            'product_name' => 'required|max:255|unique:products,product_name,'.$id,
            'cateory_id' => 'required|max:255|products,cateory_id,'.$id,

        ],[

            'product_name.required' =>'يرجي ادخال اسم المنتج',
            'cateory_id.required' =>'اسم القسم مسجل مسبقا',

        ]);

        $products = products::find($id);

        $products->update([

            'id'=>$request->product_id,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'Purchasing_price'=> $request->Purchasing_price,
            'Wholesale_price'=> $request->Wholesale_price,
            'retail_price'=>$request->retail_price,
            'Quantity'=>$request->Quantity,
            'date_of_supply'=>$request->date_of_supply,
            'Expiry_date'=>$request->Expiry_date,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل المنتج بنجاج');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
        //
        $id = $request->id;
        products::find($id)->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}
