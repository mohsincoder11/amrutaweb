<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopbookordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopbookorders', function (Blueprint $table) {
            $table->id();
            $table->integer('masterid');
            $table->date('orderdate');
            $table->string('orderno','10');
            $table->string('mobile','13');
            $table->text('details');
            $table->text('address');
            $table->string('mop','50');
            $table->integer('discount');

            $table->integer('amount');


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
        Schema::dropIfExists('shopbookorders');
    }
}
