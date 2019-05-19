<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

const PRODUCTS = 'products';

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PRODUCTS, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('brand');
            $table->float('unit_price');
            $table->integer('quantity', false, true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(PRODUCTS);
    }
}
