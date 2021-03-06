<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartament_service', function (Blueprint $table) {
            $table->unsignedInteger('apartament_id')->nullable();
            $table->unsignedInteger('service_id')->nullable();
            
            $table->foreign('apartament_id')->references('id')->on('apartaments');
            $table->foreign('service_id')->references('id')->on('services');

            $table->primary(['apartament_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartament_service');
    }
}
