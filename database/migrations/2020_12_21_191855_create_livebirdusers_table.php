<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivebirdusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livebirdusers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',10);
            $table->integer('stos');
            $table->integer('gtog');
            $table->integer('stog');
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
        Schema::dropIfExists('livebirdusers');
    }
}
