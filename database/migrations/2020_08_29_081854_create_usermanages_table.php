<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsermanagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usermanages', function (Blueprint $table) {
            $table->id();
            $table->string('username','100');
                        $table->string('uniqueprefix','10');

            $table->string('password','100');
            $table->string('email','100');
            $table->integer('role');
            $table->integer('master');
            $table->integer('shop');
            $table->integer('telecaller');
            $table->integer('report');

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
        Schema::dropIfExists('usermanages');
    }
}
