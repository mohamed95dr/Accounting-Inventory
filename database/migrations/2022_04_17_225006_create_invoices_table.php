<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Invoice_type',30);
            $table->date('invoice_date');
            $table->string('products');
             $table->decimal('total_amount',8,2);
            $table->decimal('amount_received',8,2);
            $table->decimal('remainder_amount',8,2);
            $table->string('status',50);
            $table->integer('value_status');
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
