<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('wifi')->nullable();
            $table->boolean('parking_place')->nullable();
            $table->boolean('swimming_pool')->nullable();
            $table->boolean('gatehouse')->nullable();
            $table->boolean('sea_view')->nullable();
            $table->boolean('mountain_view')->nullable();
            $table->boolean('garden')->nullable();
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
        Schema::dropIfExists('services');
    }
}
