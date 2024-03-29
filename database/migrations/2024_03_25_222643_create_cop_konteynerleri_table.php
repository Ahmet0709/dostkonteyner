<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopKonteynerleriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cop_konteynerleri'); // Mevcut tabloyu siler

        Schema::create('cop_konteynerleri', function (Blueprint $table) {
            $table->id();
            $table->string('konteyner_adi');
            $table->decimal('latitude', 10, 8)->nullable(); // Enlem bilgisini tutacak sütun
            $table->decimal('longitude', 11, 8)->nullable(); // Boylam bilgisini tutacak sütun
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
        Schema::dropIfExists('cop_konteynerleri');
    }
}
