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
        Schema::create('pavillons', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->unique();
            $table->enum('type_pavillon',['Mixte','Homme','Femme']);
            $table->integer('nombres_etages');
            $table->bigInteger('nombres_chambres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pavillons');
    }
};
