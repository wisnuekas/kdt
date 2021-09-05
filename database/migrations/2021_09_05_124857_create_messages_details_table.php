<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_details', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->unsignedBigInteger('messages_id');
            $table->unsignedBigInteger('sender_id');
            $table->timestamps();

            $table->foreign('messages_id')->references('id')->on('messages');
            $table->foreign('sender_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages_details');
    }
}
