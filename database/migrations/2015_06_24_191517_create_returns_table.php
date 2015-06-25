<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('returns', function(Blueprint $table) {
                    $table->char('id', 36)->primary();
                    $table->char('user_id', 36);
                    $table->text('name');
                    $table->bigInteger('download_counter')->default(0);
                    $table->timestamps();
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('returns');
    }

}
