<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstoqueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estoque', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_produto');
			$table->integer('id_fornecedor');
			$table->string('lote', 30)->nullable();
			$table->date('fabricacao');
			$table->date('validade')->nullable();
			$table->integer('quantidade');
			$table->float('valor', 10, 0);
			$table->unique(['id_produto','lote','id_fornecedor'], 'id_produto');
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
		Schema::drop('estoque');
	}

}
