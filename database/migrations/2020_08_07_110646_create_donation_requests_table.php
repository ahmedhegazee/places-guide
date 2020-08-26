<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration
{

	public function up()
	{
		Schema::create('donation_requests', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->smallInteger('age')->unsigned();
			$table->integer('blood_type_id')->unsigned();
			$table->smallInteger('no_blood_bags')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->string('phone', 11);
			$table->text('notes')->nullable();
			$table->string('address')->nullable();
			$table->decimal('longtitude', 10, 6)->nullable();
			$table->decimal('latitude', 10, 6)->nullable();
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
