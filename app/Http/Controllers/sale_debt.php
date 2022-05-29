<?php

namespace App\Http\Controllers;

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
        $sale_debt = SaleDebt::all();
        return view('sale_debt',compact('sale_debt'));
    }
}
