<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkersCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('workers_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
		});
	}

	public function down()
	{
		Schema::drop('workers_categories');
	}
}