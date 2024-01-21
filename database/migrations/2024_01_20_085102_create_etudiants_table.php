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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('INE')->unique(); //N01662320222
            $table->enum('sexe',['Homme','Femme']);
            $table->enum('status',['actif','inactif'])->default('actif');
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('adresse')->nullable();
            $table->string('niveau_etudes')->nullable();
            $table->string('filiere');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
