<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreditTableAndUserCredit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unloked_tarrains', function(Blueprint $t){
            $t->increments('id');
            $t->integer('user_id');
            $t->integer('terrain_id');
            $t->softDeletes();
            $t->timestamps();
        });

        Schema::table('users', function(Blueprint $t){
            $t->float('credit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('unloked_tarrains');
        Schema::table('users', function(Blueprint $t){
            $t->dropColumn('credit');
        });

    }
}
