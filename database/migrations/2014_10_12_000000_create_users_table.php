<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('cpf');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('birth')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('avatar', 191)->nullable();
            $table->boolean('system')->default(0);
            $table->boolean('terms')->default(1);
            $table->integer('status')->default(1);

            $table->unsignedBigInteger('institution_id')->default(1);
            $table->foreign('institution_id')
                ->references('id')
                ->on('institutions')
                ->onDelete('cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
