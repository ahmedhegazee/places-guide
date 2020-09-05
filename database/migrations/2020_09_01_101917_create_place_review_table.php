<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlaceReviewTable extends Migration {

	public function up()
	{
		Schema::create('place_review', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('place_id')->unsigned();
			$table->integer('review_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('place_review');
	}
}