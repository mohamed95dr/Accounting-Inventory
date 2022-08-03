<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale__invoices', function (Blueprint $table) {
            // $table->id()->primary();//scrole number every day
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('costomers')->onDelete('cascade');
            $table->unsignedBigInteger('saleDebt_id')->nullable();
            $table->foreign('saleDebt_id')->references('id')->on('sale_debts')->onDelete('cascade');
            // $table->date('invoice_date')->primary();//date
            $table->date('invoice_date');
            $table->decimal('total_amount',8,2);//total_price
            $table->decimal('amount_received',8,2);//amount_paid
            $table->decimal('remainder_amount',8,2);//remander_debt
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
        Schema::dropIfExists('sale__invoices');
    }
}
