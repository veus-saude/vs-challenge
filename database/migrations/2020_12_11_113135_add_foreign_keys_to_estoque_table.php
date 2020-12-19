<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEstoqueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estoque', function(Blueprint $table)
		{
			$table->foreign('id_produto', 'produto_estoque')->references('id')->on('produtos')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_fornecedor', 'fornecedor_estoque')->references('id')->on('fornecedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('estoque', function(Blueprint $table)
		{
			$table->dropForeign('produto_estoque');
			$table->dropForeign('fornecedor_estoque');
		});
	}

}
