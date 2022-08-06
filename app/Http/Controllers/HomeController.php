<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\ReceiptDebt;
use App\Models\Sale_Invoice;
use App\Models\sale_invoice_details;
use App\Models\SaleDebt;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $c = date("Y-m-d");
       $SaleInvoices = Sale_Invoice::where('invoice_date', $c)->get();
             $saleInvoice_count=count($SaleInvoices);

                   
            $sum = 0;
            $capital = 0;
            $invoiceAmount = 0 ;
        foreach($SaleInvoices as $s){
          
            $invoice_amount= $s->total_amount - $s->remainder_amount;
            $invoiceAmount += $invoice_amount;
           $product= sale_invoice_details::where('sale_invoices_id',$s->id)->get();

            foreach($product as $p){
                $purchasing_price = products ::select ('Purchasing_price')->where('id',$p->product_id)->first()->Purchasing_price;
                $sum = $purchasing_price * $p->quantity ; 
                $capital += $sum;
                 
            } 

            
        }

      $gain = $invoiceAmount - $capital ;

      $saleDebt = SaleDebt::all();
      $saleDebt_sum = 0 ;
      foreach($saleDebt as $d){
        $saleDebt_sum += $d->cost;
      }
      
      $receiptDebt = ReceiptDebt::all();
      $receiptDebt_sum = 0;

      foreach($receiptDebt as $rd){
        $receiptDebt_sum += $rd->cost;
      }

    //   $chartjs = app()->chartjs
    //      ->name('barChartTest')
    //      ->type('bar')
    //      ->size(['width' => 400, 'height' => 200])
    //      ->labels(['Label x', 'Label y'])
    //      ->datasets([
    //          [
    //              "label" => "My First dataset",
    //              'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
    //              'data' => [69, 59]
    //          ],
    //          [
    //              "label" => "My First dataset",
    //              'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
    //              'data' => [65, 12]
    //          ]
    //      ])
    //      ->options([]);

        
        return view('home',compact('gain','saleInvoice_count','saleDebt_sum','receiptDebt_sum'));
    }
}
