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
        Schema::create('scolarites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained('classes');
            $table->integer('montant');
            $table->text('description');
            $table->foreignId('annee_scolaire_id')->constrained('annee_scolaires');
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
        Schema::dropIfExists('scolarites');
    }
};
