<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrawingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('drawings', function($table)
    {
      $table->increments('id')->unsigned(); 
      $table->integer('user_id')->unsigned();
      $table->integer('original_user_id')->unsigned();
      $table->string('name');
      $table->binary('img_thumb');
      $table->boolean('is_public')->default(false);
      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('original_user_id')->references('id')->on('users');
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
    DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
		Schema::drop('drawings');
	}

}
