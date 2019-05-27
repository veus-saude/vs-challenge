<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->unsignedBigInteger('brand_id')->nullable(false);
            $table->string('product_name')->nullable(false);
            $table->float('product_price',8,2)->nullable(false);
            $table->integer('product_qty')->nullable(false);
            $table->timestamps();
            $table->foreign('brand_id')->references('brand_id')->on('brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
