<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('avatar')->nullable();
			$table->string('password', 60);
			$table->longText('file_id');
			$table->rememberToken();
			$table->timestamps();
		});

        Schema::table('users', function ($table) {
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
		Schema::drop('users');
	}

}
