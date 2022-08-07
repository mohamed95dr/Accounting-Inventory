<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\products;
use Illuminate\Http\Request;

class stocktaking extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        // return $request;
        $categories = Categories::select('cateory_name')->get();

        $products = products::select('id', 'product_name', 'category_id', 'Quantity')->get();
        // $products[0]->categories->cateory_name;

        // $filtered = $products->filter(function ($value, $key) {
        //     $value->Quantity > 100;
        // });
        // return $filtered;
        return view('stocktaking', compact('products', 'categories'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        // return "run";
        $category_id = Categories::select('id')->where('cateory_name',$request->cateory_name)->first()->id;
        $categories = Categories::select('cateory_name')->get();

         $products = products::select('id', 'product_name', 'category_id', 'Quantity')->where('category_id',$category_id)->get();
          
         $total_quantity = 0;
         foreach($products as $p){
            $total_quantity += $p->Quantity;
         }
        //  return $total_quantity;
          

        return view('stocktaking_filter', compact('products','categories','total_quantity'));
    }

    
    public function validation(Request $request){
        
        return $request;

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
