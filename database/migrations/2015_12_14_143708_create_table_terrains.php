<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTerrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terrains', function (Blueprint $t) {
            $t->increments('id');
            $t->string('title');
            $t->integer('user_id');
            $t->text('description');
            $t->text('history');
            $t->string('type');
            $t->text('geometry');
            $t->float('radius');
            $t->text('style');
            $t->integer('id_locatie');
            $t->text('suprafata');
            $t->integer('id_tip_teren');
            $t->text('deschidere');
            $t->integer('id_tip_caracteristici')->nullable();
            $t->text('photo');
            $t->text('pret',20);
            $t->text('telefon', 20);
            $t->text('proprietar',30);
            $t->text('negociabil', 5);
            $t->text('detalii');
            $t->tinyinteger('front_stradal')->nullable();
            $t->integer('nr_fronturi');
            $t->integer('latime_drum_acces');
            $t->integer('constructie_teren');
            $t->integer('detalii_2');
            $t->tinyInteger('aprobat')->nullable();
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
        Schema::drop('terrains');
    }
}
