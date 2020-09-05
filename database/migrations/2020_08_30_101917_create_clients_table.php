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
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->tinyInteger('is_banned')->default(0);
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::drop('clients');
    }
}