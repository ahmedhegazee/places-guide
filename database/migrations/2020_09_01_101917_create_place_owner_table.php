<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlaceOwnerTable extends Migration
{

    public function up()
    {
        Schema::create('place_owner', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('account_type')->default(0);
            $table->tinyInteger('is_banned')->default(0);
            $table->tinyInteger('is_accepted')->default('0');
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::drop('place_owner');
    }
}