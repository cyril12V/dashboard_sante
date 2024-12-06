<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nom de l'objectif
            $table->text('description')->nullable(); // Description de l'objectif
            $table->integer('step_goal'); // Objectif de pas
            $table->enum('status', ['in_progress', 'completed', 'canceled']); // Statut de l'objectif
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien vers l'utilisateur
            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('goals');
    }
}
