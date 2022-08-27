<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGodawnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('godawns', function (Blueprint $table) {
            $table->id();
            $table->text('address');
            $table->string('geolocation',100);
            $table->string('pername',100);
            $table->string('godawnname',100);
            $table->string('mobno',13);
            $table->string('capacity',10);
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
        Schema::dropIfExists('godawns');
    }
}
