<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

const TABLE_NAME = 'users';
const COLUMN_NAME = 'api_token';

class AddApiTokenColumnToUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(TABLE_NAME, function (Blueprint $table) {
            $table->string(COLUMN_NAME, 80)->after('password')
                ->unique()
                ->nullable()
                ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn(TABLE_NAME, COLUMN_NAME))
            Schema::table(TABLE_NAME, function (Blueprint $table) {
                $table->dropColumn(COLUMN_NAME);
            });
    }
}
