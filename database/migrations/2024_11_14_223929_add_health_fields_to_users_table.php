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
            $table->date('last_consultation')->nullable();
            $table->integer('average_heart_rate')->nullable();
            $table->integer('daily_step_goal')->nullable();
            $table->string('sleep_quality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_consultation');
            $table->dropColumn('average_heart_rate');
            $table->dropColumn('daily_step_goal');
            $table->dropColumn('sleep_quality');
        });
    }
};
