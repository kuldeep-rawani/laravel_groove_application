<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tasks', function (Blueprint $table) { 
            //$table->integer('user_id');
            //$table->foreign('user_id')->reference('id')->on('users');
            $table->increments('task_id');
            $table->string('body');
            $table->string('subject');
            $table->string('author');
            //$table->string('to');
            //$table->string('assign_to');
            $table->integer('status_id');    
            $table->softDeletes();          
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
        //
        Schema::drop('tasks');
    }
}
