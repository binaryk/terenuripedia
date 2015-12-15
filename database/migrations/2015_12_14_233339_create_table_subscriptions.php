<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_subscriptions', function(Blueprint $t){
            $t->increments('id');
            $t->text('name',60);
            $t->tinyInteger('free_post');
            $t->tinyInteger('saller_free_view_terrain');
            $t->tinyInteger('saller_free_view_contact');
            $t->tinyInteger('saller_can_pay_for_contact');
            $t->float('price_month');
            $t->float('price_year');
            $t->float('price_semester');
            $t->float('price_per_terrain');
            $t->float('price_min_terrains_year_year');
            $t->float('price_min_terrains_year_month');
            $t->float('price_min_terrains_semester_year');
            $t->float('price_min_terrains_semester_month');
            $t->integer('count_visible_terrain_contact');
            $t->integer('min_terrains_year');
            $t->integer('min_terrains_semester');
            $t->text('descriptions');
            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('config_subscriptions');
    }
}
