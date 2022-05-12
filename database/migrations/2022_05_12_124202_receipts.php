<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Receipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->unsignedBigInteger('receipt_products_id');
            $table->foreign('receipt_products_id')->references('id')->on('receipt_products')->onDelete('cascade');
            $table->date('date_of_supply');
            $table->date('Expiry_date');
            $table->unsignedBigInteger('receiptDebt_id');
            $table->foreign('receiptDebt_id')->references('id')->on('receipt_debts')->onDelete('cascade');
            $table->date('invoice_date');
            $table->decimal('total_price',8,2);
            $table->decimal('amount_paid',8,2);
            $table->decimal('remainder_debt',8,2);
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
