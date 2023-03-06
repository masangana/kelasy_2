<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cours_id')->constrained('cours');
            $table->foreignId('eleve_id')->constrained('users');
            $table->foreignId('periode_id')->constrained('periodes');
            $table->foreignId('epreuve_id')->constrained('epreuves');
            $table->foreignId('annee_scolaire_id')->constrained('annee_scolaires');
            $table->foreignId('groupe_cote_id')->constrained('groupe_cotes');
            $table->integer('cote')->unsigned();
            $table->integer('max')->unsigned();
            $table->string('commentaire')->nullable();
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
        Schema::dropIfExists('cotes');
    }
};
