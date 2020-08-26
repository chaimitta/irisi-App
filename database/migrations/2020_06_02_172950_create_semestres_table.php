<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semestres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('int_semestre');
            $table->unsignedBigInteger('annee_univ_id');
            $table->timestamps();

            $table->foreign('annee_univ_id')->references('id')->on('annee_univs');
            $table->index('annee_univ_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semestres');
    }
}
