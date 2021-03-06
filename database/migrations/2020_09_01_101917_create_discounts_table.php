<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscountsTable extends Migration
{

    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('place_id')->unsigned();
            $table->json('title');
            $table->json('content');
            $table->string('discount');
            $table->date('starting_date');
            $table->date('end_date');
            $table->string('image');
        });
    }

    public function down()
    {
        Schema::drop('discounts');
    }
}
