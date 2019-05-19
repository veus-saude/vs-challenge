<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApiTokenColumnToUsersTable extends Migration
{
    const TABLE_NAME = 'users';
    const COLUMN_NAME = 'api_token';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->string(self::COLUMN_NAME, 80)->after('password')
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
        if (Schema::hasColumn(self::TABLE_NAME, self::COLUMN_NAME))
            Schema::table(self::TABLE_NAME, function (Blueprint $table) {
                $table->dropColumn(self::COLUMN_NAME);
            });
    }
}
