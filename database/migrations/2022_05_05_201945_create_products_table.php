<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('product_name'); //name
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('Purchasing_price');
            $table->string('percentage_wholesale_price')->nullable();
            $table->string('Wholesale_price');
            $table->string('Retail_price_percentage')->nullable();
            $table->string('retail_price');
            $table->string('Quantity');//quentity
            $table->string('Minimum_Quantity')->nullable();
            $table->date('date_of_supply');//supply_date
            $table->date('Expiry_date');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
