<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnseignesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('professeur_id');
            $table->unsignedBigInteger('semestre_id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('niveau_id');
            $table->timestamps();

            $table->foreign('professeur_id')->references('id')->on('professeurs');
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('niveau_id')->references('id')->on('niveaux');
            $table->index('professeur_id');
            $table->index('semestre_id');
            $table->index('module_id');
            $table->index('niveau_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseignes');
    }
}
