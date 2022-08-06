<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReceiptProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('receipt_products', function (Blueprint $table) {//receipt_invoice_details

        // $table->id()->primary();
        $table->id();

        $table->string('product_id');
        // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        
        $table->unsignedBigInteger('receiptDebt_id');
        $table->foreign('receiptDebt_id')->references('id')->on('receipt_debts')->onDelete('cascade');

        $table->unsignedBigInteger('receipts_id');//receipts_invoices-id
        $table->foreign('receipts_id')->references('id')->on('receipts')->onDelete('cascade');
        
        $table->decimal('quantity');

        $table->date('invoice_date');
        $table->decimal('Pruchasing_price',8,2);
        $table->decimal('wholesale_price',8,2);
        $table->decimal('retail_price',8,2);
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
