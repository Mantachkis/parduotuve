<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('plate', 255);
            $table->text('about');
            $table->unsignedBigInteger('maker_id');
            $table->foreign('maker_id')->references('id')->on('makers');
            //is sitos lenteles->surida pagal maker_id->su id->is lenteles makers
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
        Schema::dropIfExists('cars');
    }
}