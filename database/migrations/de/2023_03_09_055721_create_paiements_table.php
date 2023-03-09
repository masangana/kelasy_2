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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('users');
            $table->foreignId('personnel_id')->constrained('users');
            $table->integer('montant')->unsigned();
            $table->foreignId('motif_id')->constrained('motifs');
            $table->foreignId('annee_scolaire_id')->constrained('annee_scolaires');
            $table->text('description')->nullable();
            $table->boolean('validate')->default(true);
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
        Schema::dropIfExists('paiements');
    }
};
