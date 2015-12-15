<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCharacteristicsTerrain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics_terrain', function(Blueprint $t){
            $t->integer('id_characteristics');
            $t->integer('id_terrain');
            $t->softdeletes();
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
        Schema::drop('characteristics_terrain');
    }
}
