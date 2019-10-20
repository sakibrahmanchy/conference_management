<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverAndLogoToConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('conferences',function(Blueprint $table){
            $table->string("cover");
            $table->string("logo");
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
            $table->dropColumn("user_id");
        });
    }
}
