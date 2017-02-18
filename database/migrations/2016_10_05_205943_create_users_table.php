<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('presentDesignation');
            $table->date('pdJoiningDate');
            $table->string('pdJoiningTime');
            $table->string('payScale');
            $table->string('firstDesignation');
            $table->date('firstJoiningDate');
            $table->date('birthDate');
            $table->enum('maritalStatus', ['Married', 'Unmarried', 'Divorced'])->default('Unmarried');
            $table->string('department');
            $table->string('phone');
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
        Schema::drop('users');
    }
}
