<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConferenceIdToTracksTable extends Migration
{

    public function up()
    {
          Schema::table('tracks',function(Blueprint $table){
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
        Schema::table('tracks',function(Blueprint $table){
            $table->dropColumn("conference_id");
        });
    }
}
