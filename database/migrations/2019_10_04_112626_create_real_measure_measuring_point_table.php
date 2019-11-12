<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealMeasureMeasuringPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_measure_measuring_point', function (Blueprint $table) {
            $table->unsignedBigInteger('real_measure_id');
            $table->unsignedBigInteger('measuring_point_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_measure_measuring_point');
    }
}
