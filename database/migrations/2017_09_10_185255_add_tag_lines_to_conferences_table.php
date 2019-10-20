<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagLinesToConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {

        Schema::table('conferences',function(Blueprint $table){
            $table->text("tag_lines");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('conferences',function(Blueprint $table){
            $table->dropColumn("tag_lines");
        });
    }
}
