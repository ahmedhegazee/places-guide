<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientMessagesTable extends Migration {

	public function up()
	{
		Schema::create('client_messages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->string('title', 255);
			$table->text('content');
		});
	}

	public function down()
	{
		Schema::drop('client_messages');
	}
}