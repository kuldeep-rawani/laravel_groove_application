<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiverMailIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiver_mail_id', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->foreign('task_id')->references('task_id')->on('tasks');
            $table->string('email');
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
        Schema::drop('receiver_mail_id');
    }
}
