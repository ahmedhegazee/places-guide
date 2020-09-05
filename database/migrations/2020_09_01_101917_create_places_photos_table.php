<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlacesPhotosTable extends Migration {

	public function up()
	{
		Schema::create('places_photos', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('place_id')->unsigned();
			$table->string('src');
		});
	}

	public function down()
	{
		Schema::drop('places_photos');
	}
}