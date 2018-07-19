<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartament_feature', function (Blueprint $table) {
            $table->unsignedInteger('apartament_id');
            $table->unsignedInteger('feature_id');
            $table->foreign('apartament_id')->references('id')->on('apartaments');
            $table->foreign('feature_id')->references('id')->on('features');
            $table->primary(['apartament_id', 'feature_id']);

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
        Schema::dropIfExists('apartament_feature');
    }
}
