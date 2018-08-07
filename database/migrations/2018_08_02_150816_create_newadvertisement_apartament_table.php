<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewAdvertisementApartamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_apartament', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('apartament_id')->nullable();
            $table->unsignedInteger('advertisement_id')->nullable();
            $table->dateTime('valid_until');
            
            $table->foreign('apartament_id')->references('id')->on('apartaments');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
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
        Schema::dropIfExists('advertisement_apartament');
    }
}
