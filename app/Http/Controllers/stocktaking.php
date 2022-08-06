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

        // // filter test
        // $collection = collect([1, 2, 3, 4]);
        // $filtered = $collection->filter(function ($value, $key) {
        //     return $value > 2;
        // });
        // return $filtered;
        // //

        // return $request;
        $categories = Categories::select('cateory_name')->get();

        $products = products::select('id', 'product_name', 'category_id', 'Quantity')->get();
        $products[0]->categories->cateory_name;

        $filtered = $products->filter(function ($value, $key) {
            $value->Quantity > 100;
        });
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
        // return $request;
        $categories = Categories::select('cateory_name')->get();

        $products = products::select('id', 'product_name', 'category_id', 'Quantity')->get();
        $products[0]->categories->cateory_name;

        $filtered = $products->filter(function ($value, $key) {
            $value->Quantity > 100;
        });
        // return $filtered;
        return view('stocktaking_filter', compact('filtered'));
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
