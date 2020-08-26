<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emplois');
            $table->unsignedBigInteger('semestre_id');
            $table->unsignedBigInteger('niveau_id');
          
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->foreign('niveau_id')->references('id')->on('niveaux');
            $table->index('semestre_id');
            $table->index('niveau_id');
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
        Schema::dropIfExists('emplois');
    }
}
