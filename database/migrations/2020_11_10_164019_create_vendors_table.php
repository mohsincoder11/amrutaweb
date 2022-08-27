<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('address');
            $table->string('mobno',13);
            $table->string('email',70);
            $table->string('pan',25);
            $table->string('bankname',200); 
            $table->string('accno',20);
            $table->string('ifsccode',20);
            $table->string('shedsize',20);
            $table->string('capacity',10);
            $table->string('distance',10);
            $table->string('geolocation',100);
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
        Schema::dropIfExists('vendors');
    }
}
