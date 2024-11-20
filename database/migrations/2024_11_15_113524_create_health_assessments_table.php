<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('health_assessments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nom');
        $table->string('prenom');
        $table->integer('age');
        $table->decimal('poids', 5, 2);
        $table->integer('taille');
        $table->string('rhesus');
        $table->text('allergies')->nullable();
        $table->decimal('imc', 4, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_assessments');
    }
};
