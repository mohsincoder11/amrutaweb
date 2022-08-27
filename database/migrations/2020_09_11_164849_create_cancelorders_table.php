<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelorders', function (Blueprint $table) {
            $table->id();
             $table->integer('masterid');
             $table->integer('teleorderid');
           $table->string('orderdate','50');
            $table->string('orderno','10');
            $table->string('custname','150');
            $table->string('mobile','13');
            $table->text('details');
            $table->text('address');
            $table->text('shopname');
            $table->string('mop','50');
            $table->string('timetaken','50');
            $table->string('assignto','300');
            $table->integer('deliveryboyid');

            $table->integer('timestatus');
                        $table->integer('paidstatus');
                        $table->integer('collectedcash');

            $table->text('reason');
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
        Schema::dropIfExists('cancelorders');
    }
}
