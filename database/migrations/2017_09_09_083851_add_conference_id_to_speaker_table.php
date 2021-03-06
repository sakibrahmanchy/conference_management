<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConferenceIdToSpeakerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('speakers',function(Blueprint $table){
            $table->text("conference_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('speakers',function(Blueprint $table){
            $table->dropColumn("conference_id");
        });
    }
}
