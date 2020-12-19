<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTypeUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('type_users', function(Blueprint $table)
		{
			$table->foreign('type_id')->references('id')->on('type')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('type_users', function(Blueprint $table)
		{
			$table->dropForeign('type_users_type_id_foreign');
			$table->dropForeign('type_users_user_id_foreign');
		});
	}

}
