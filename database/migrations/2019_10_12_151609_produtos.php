<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Produtos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('produtos', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->char('nome', 100);
        $table->char('marca', 100);
        $table->decimal('preco', 14,2);
        $table->integer('quantidade_estoque');
        $table->dateTime('created_at')->useCurrent();
        $table->dateTime('updated_at')->useCurrent();
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
