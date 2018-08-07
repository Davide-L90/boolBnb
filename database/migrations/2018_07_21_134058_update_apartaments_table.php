<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateApartamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartaments', function (Blueprint $table) {
            $table->decimal('latitude', 11, 8)->change();
            $table->decimal('longitude', 11, 8)->change();
            $table->unsignedSmallInteger('area')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartaments', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->change();
            $table->decimal('longitude', 10, 8)->change();
            $table->unsignedTinyInteger('area')->change();
        });
    }
}
