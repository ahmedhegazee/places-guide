<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration
{

	public function up()
	{
		Schema::create('clients', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('password', 255);
			$table->string('email', 255)->unique();
			$table->string('phone', 11)->unique();
			$table->date('dob');
			$table->date('last_donation_date');
			$table->integer('city_id')->unsigned();
			$table->string('pin_code')->nullable();
			$table->string('api_token')->unique()->nullable();
			$table->smallInteger('is_banned')->default(0);
			$table->integer('blood_type_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
