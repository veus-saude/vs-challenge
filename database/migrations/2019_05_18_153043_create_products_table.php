<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    const PRODUCTS = 'products';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::PRODUCTS, function (Blueprint $table) {
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
        Schema::dropIfExists(self::PRODUCTS);
    }
}
