<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('etudiant_id');
            $table->string('C1')->nullable();
            $table->string('C2')->nullable();
            $table->timestamps();
            
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('etudiant_id')->references('id')->on('etudiants');
            $table->index('module_id');
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
        Schema::dropIfExists('notes');
    }
}
