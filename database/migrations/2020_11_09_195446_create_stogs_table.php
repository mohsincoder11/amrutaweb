<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stogs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');            
            $table->string('targetgod',100);
            $table->string('sourceshop',100);
            $table->string('vehicleno',20);
            $table->string('drivername',100);
            $table->integer('livebird');
                        $table->string('totalwt',20);
            $table->string('avgwt',20);
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
        Schema::dropIfExists('stogs');
    }
}
