<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->enum('type_chambre',['Individuelle','Partagée']);
            $table->Integer('nombres_lits');
            $table->string('echeances')->default('1 ans');
            $table->Integer('nombres_limites')->max(12);
            $table->unsignedBigInteger('pavillons_id');
            $table->unsignedBigInteger('etudiants_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};
