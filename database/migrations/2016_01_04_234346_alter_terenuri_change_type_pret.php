<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTerenuriChangeTypePret extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terrains', function(Blueprint $t){
            $t->dropColumn('pret','negociabil');
        });
        Schema::table('terrains', function(Blueprint $t){
            $t->float('pret')->after('suprafata');
            $t->tinyInteger('negociabil')->after('nr_fronturi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terrains', function(Blueprint $t){
            $t->dropColumn('pret','negociabil');
        });
        Schema::table('terrains', function(Blueprint $t){
            $t->text('pret');
            $t->text('negociabil', 5);
        });
    }
}
