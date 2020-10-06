<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('sub_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->json('name');
			$table->integer('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('sub_categories');
	}
}
