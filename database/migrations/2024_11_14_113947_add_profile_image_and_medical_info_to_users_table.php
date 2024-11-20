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
        Schema::table('users', function (Blueprint $table) {
            // Ajouter les colonnes pour l'image de profil et les informations médicales
            $table->string('profile_image')->nullable();  // Champ pour l'image de profil
            $table->text('medical_info')->nullable();      // Champ pour les informations médicales
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées si la migration est annulée
            $table->dropColumn('profile_image');
            $table->dropColumn('medical_info');
        });
    }
};
