<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pincode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('officename');
            $table->integer('pincode');
            $table->string('officetype');
            $table->string('deliverystatus');
            $table->string('divisionname');
            $table->string('regionname');
            $table->string('circlename');
            $table->string('taluk');
            $table->string('districtname');
            $table->string('statename');
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
        Schema::dropIfExists('pincode');
    }
}
