<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributes', function (Blueprint $table) {
            $table->id();
             $table->date('date');
            $table->time('time');
            $table->string('vehno',20);
            $table->string('drivername',150);
            $table->integer('noofbirds');
            $table->string('totalwt',10);
            $table->string('avgbirdwt',10);
            $table->string('shopcutunit',100);
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
        Schema::dropIfExists('distributes');
    }
}
