<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('venue');
            $table->date('paper_submission_deadline');
            $table->date('notification_of_acceptance_date')->nullable();
            $table->date('camera_ready_paper_date')->nullable();
            $table->date('registration_deadline')->nullable();
            $table->date('conference_start_date');
            $table->date('conference_end_date');
            $table->string('poster')->nullable();
            $table->string('conference_url');
            $table->text('submission_guideline')->nullable();
            $table->text('plagiarism_policy')->nullable();
            $table->text('review_policy')->nullable();
            $table->text('best_paper_award')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conferences');
    }
}
