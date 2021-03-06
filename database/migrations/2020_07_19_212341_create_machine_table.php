<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->string('service');
           /* $table->string('model');
            $table->string('function');
            $table->string('threat');
            $table->integer('status');*/
            $table->integer('cost');
            $table->string('origin');
            $table->dateTime('addDate');
            $table->dateTime('expirationDate');
           /* $table->dateTime('lastStatusUpdateDate');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machines');
    }
}
