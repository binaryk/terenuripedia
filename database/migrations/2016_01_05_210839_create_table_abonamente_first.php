<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAbonamenteFirst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonamente', function(Blueprint $t){
            $t->increments('id');
            $t->tinyInteger('config_subscriptions_id');
            $t->integer('user_id');
            $t->dateTime('efectuare_plata');
            $t->float('suma');
            $t->dateTime('expirare');
            $t->softDeletes();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abonamente');
    }
}
