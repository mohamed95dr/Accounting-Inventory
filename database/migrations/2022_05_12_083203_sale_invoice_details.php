<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SaleInvoiceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sale_invoice_details', function (Blueprint $table) {
        $table->id();
        $table->date('invoice_date');
        $table->unsignedBigInteger('sale_invoices_id');
        $table->foreign('sale_invoices_id')->references('id')->on('sale__invoices')->onDelete('cascade');
        $table->unsignedBigInteger('product_id');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->decimal('quantity',8,2);
        $table->decimal('unit_price',8,2);
        $table->decimal('total_price',8,2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
