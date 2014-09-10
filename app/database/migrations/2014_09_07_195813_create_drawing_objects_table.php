<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrawingObjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drawing_objects', function($table)
    {
      $table->increments('id')->unsigned(); 
      $table->integer('drawing_id')->unsigned();
      $table->integer('amplitudeX');
      $table->integer('amplitudeY');
      $table->integer('time');
      $table->string('shape');
      $table->string('color');
      $table->foreign('drawing_id')->references('id')->on('drawings');
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
		Schema::drop('drawing_objects');
	}

}
