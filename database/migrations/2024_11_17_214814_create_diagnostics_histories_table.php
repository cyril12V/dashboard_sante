<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('diagnostics_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('disease_name');
        $table->json('symptoms'); // Pour stocker les symptômes soumis
        $table->timestamp('diagnosed_at'); // Date du diagnostic
        $table->timestamps();

        // Clé étrangère pour relier à l'utilisateur
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics_histories');
    }
};
