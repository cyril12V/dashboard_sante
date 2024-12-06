<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index(); // Associer chaque tableau de bord à un utilisateur
            $table->date('last_consultation')->nullable();
            $table->integer('average_heart_rate')->nullable();
            $table->integer('daily_step_goal')->nullable();
            $table->string('sleep_quality')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboards');
    }
};
