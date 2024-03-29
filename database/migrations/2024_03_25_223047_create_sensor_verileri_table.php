<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorVerileriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_verileri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cop_konteyneri_id');
            $table->foreign('cop_konteyneri_id')->references('id')->on('cop_konteynerleri')->onDelete('cascade');
            $table->float('doluluk_orani')->nullable(); // NULL değere izin ver
            $table->float('sicaklik')->nullable(); // NULL değere izin ver
            $table->float('nem')->nullable(); // NULL değere izin ver
            $table->float('hava_kalitesi')->nullable(); // NULL değere izin ver
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
        Schema::dropIfExists('sensor_verileri');
    }
}
