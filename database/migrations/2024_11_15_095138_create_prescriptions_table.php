<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Lié à l'utilisateur
            $table->string('medication_name'); // Nom du médicament
            $table->string('dosage'); // Dosage (ex : 2 fois par jour)
            $table->date('start_date'); // Date de début du traitement
            $table->date('end_date'); // Date de fin du traitement
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
