<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkAdsTable extends Migration
{

    public function up()
    {
        Schema::create('work_ads', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('work_category_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->string('title');
            $table->text('content');
        });
    }

    public function down()
    {
        Schema::drop('work_ads');
    }
}