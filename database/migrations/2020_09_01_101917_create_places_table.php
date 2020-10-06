<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlacesTable extends Migration
{

    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->json('name');
            $table->integer('city_id')->unsigned();
            $table->json('address');
            $table->json('about');
            $table->decimal('latitude', 10, 6)->index()->nullable();
            $table->decimal('longitude', 10, 6)->index()->nullable();
            $table->integer('place_owner_id')->unsigned()->nullable();
            $table->string('phone');
            $table->string('tax_record');
            $table->integer('category_id')->unsigned();
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->tinyInteger('is_best')->default('0');
            $table->bigInteger('visited_count')->unsigned()->default(0);
            $table->time('opened_time');
            $table->time('closed_time');
            // $table->enum('closed_days', array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'));
            $table->string('closed_days');
            $table->string('website')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('main_image')->default('images/company.png');
            $table->string('video')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('places');
    }
}
