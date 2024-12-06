<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusColumnInGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goals', function (Blueprint $table) {
            // Si tu utilises un ENUM
            $table->enum('status', ['in_progress', 'achieved'])->default('in_progress')->change();
            // Ou si tu veux un VARCHAR
            // $table->string('status')->default('in_progress')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            // Si tu utilises un ENUM
            $table->enum('status', ['in_progress', 'achieved'])->default('in_progress')->change();
            // Ou si tu veux un VARCHAR
            // $table->string('status')->default('in_progress')->change();
        });
    }
}
