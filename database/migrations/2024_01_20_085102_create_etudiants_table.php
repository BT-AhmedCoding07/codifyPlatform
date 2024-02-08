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
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('adresse');
            $table->string('niveau_etudes');
            $table->string('filiere');
            $table->float('moyennes')->nullable();
            $table->boolean('estAttribue')->default(0);
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('statuts_id');
            $table->unsignedBigInteger('chambres_id');
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
