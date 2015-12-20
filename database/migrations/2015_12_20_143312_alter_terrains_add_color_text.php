<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTerrainsAddColorText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terrains', function(Blueprint $t){
            $t->text('color_text',10);
            $t->text('geometry_text',10);
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
            $t->dropColumn('color_text','geometry_text');
        });
    }
}
