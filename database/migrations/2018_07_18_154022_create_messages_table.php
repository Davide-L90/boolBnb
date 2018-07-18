<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('apartament_id')->nullable();
            $table->unsignedInteger('guest_user_id')->nullable();
            $table->text('content');
            $table->dateTime('sanding_date');
            $table->foreing('apartament_id')->references('id')->on('apartaments');
            $table->foreing('guest_user_id')->references('id')->on('guest_users');

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
        Schema::dropIfExists('messages');
    }
}
