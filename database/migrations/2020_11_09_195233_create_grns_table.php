<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grns', function (Blueprint $table) {
            $table->id();
            $table->string('grnid',50);
            $table->string('godown',100);
            $table->date('dateofpur');
            $table->string('vendor',100);
            $table->string('uidrefno',50);
            $table->string('vehno',20);
            $table->string('drivername',50);
            $table->string('transmornos',10);
            $table->string('transmorwt',10);
            $table->string('item',100);
            $table->integer('rate');
            $table->integer('quantity');
            $table->integer('noofbird');
            $table->string('avgbodywt',10);
            $table->string('amount',20);
            $table->string('labor',20);

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
        Schema::dropIfExists('purchases');
    }
}
