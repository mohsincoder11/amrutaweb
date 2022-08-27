<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailyentries', function (Blueprint $table) {
            $table->id();
             $table->integer('user_id');
             $table->date('date');
            $table->time('time');
            $table->integer('openingbird');
            $table->integer('salegbird');
            $table->string('salegwt',10);
            $table->string('billqtywt',150);
            $table->string('mortality',50);
            $table->string('wt',10);
            $table->string('closingbird',10);
            $table->string('tsaleamt',10);
            $table->string('disamt',10);
            $table->string('salablechick',10);
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
        Schema::dropIfExists('dailyentries');
    }
}
