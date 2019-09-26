<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        if (!Schema::hasTable('product')) {

            Schema::create('product', function (Blueprint $table) {

                $table->increments('id');
                $table->string('name');
                $table->unsignedInteger('brand_id');
                $table->decimal('price', 10, 2)->default(0);
                $table->integer('quantity')->default(0);
                $table->timestamps();

                $table->foreign('brand_id')
                    ->references('id')
                    ->on('brand');

            });

        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('product');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
