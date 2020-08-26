<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListeEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liste_etudiants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('niveau_id');
            $table->unsignedBigInteger('semestre_id');
            $table->unsignedBigInteger('etudiant_id');
            $table->timestamps();

            $table->foreign('niveau_id')->references('id')->on('niveaux');
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->foreign('etudiant_id')->references('id')->on('etudiants');
            $table->index('niveau_id');
            $table->index('semestre_id');
            $table->index('etudiant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liste_etudiants');
    }
}
