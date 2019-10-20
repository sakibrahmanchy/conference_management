<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaperTitleAndPaperAbstractToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {

        Schema::table('files',function(Blueprint $table){
            $table->string('paper_title');
            $table->text("paper_abstract");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('files',function(Blueprint $table){
            $table->string('paper_title');
            $table->text("paper_abstract");
        });
    }
}
