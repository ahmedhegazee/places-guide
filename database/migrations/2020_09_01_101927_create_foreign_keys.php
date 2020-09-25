<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('governorate_id')->references('id')->on('governorates')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('places', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('places', function (Blueprint $table) {
            $table->foreign('place_owner_id')->references('id')->on('place_owner')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('places', function (Blueprint $table) {
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('places', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('places_photos', function (Blueprint $table) {
            $table->foreign('place_id')->references('id')->on('places')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Schema::table('places_videos', function (Blueprint $table) {
        //     $table->foreign('place_id')->references('id')->on('places')
        //         ->onDelete('cascade')
        //         ->onUpdate('cascade');
        // });
        Schema::table('discounts', function (Blueprint $table) {
            $table->foreign('place_id')->references('id')->on('places')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('place_id')->references('id')->on('places')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('place_review', function (Blueprint $table) {
            $table->foreign('place_id')->references('id')->on('places')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('place_review', function (Blueprint $table) {
            $table->foreign('review_id')->references('id')->on('reviews')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });



        Schema::table('work_ads', function (Blueprint $table) {
            $table->foreign('work_category_id')->references('id')->on('workers_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('work_ads', function (Blueprint $table) {
            $table->foreign('place_id')->references('id')->on('places')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign('cities_governorate_id_foreign');
        });
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropForeign('sub_categories_category_id_foreign');
        });
        Schema::table('places', function (Blueprint $table) {
            $table->dropForeign('places_city_id_foreign');
        });
        Schema::table('places', function (Blueprint $table) {
            $table->dropForeign('places_place_owner_id_foreign');
        });
        Schema::table('places', function (Blueprint $table) {
            $table->dropForeign('places_sub_category_id_foreign');
        });
        Schema::table('places_photos', function (Blueprint $table) {
            $table->dropForeign('places_photos_place_id_foreign');
        });
        Schema::table('places_videos', function (Blueprint $table) {
            $table->dropForeign('places_videos_place_id_foreign');
        });
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropForeign('discounts_place_id_foreign');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_client_id_foreign');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_place_id_foreign');
        });
        Schema::table('place_review', function (Blueprint $table) {
            $table->dropForeign('place_review_place_id_foreign');
        });
        Schema::table('place_review', function (Blueprint $table) {
            $table->dropForeign('place_review_review_id_foreign');
        });


        Schema::table('work_ads', function (Blueprint $table) {
            $table->dropForeign('work_ads_work_category_id_foreign');
        });
        Schema::table('work_ads', function (Blueprint $table) {
            $table->dropForeign('work_ads_place_id_foreign');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign('clients_city_id_foreign');
        });
    }
}