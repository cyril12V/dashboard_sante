<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->integer('step_goal')->default(10000)->change(); // Définir une valeur par défaut
        });
    }
    
    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->integer('step_goal')->change(); // Revenir à l'état précédent
        });
    }
    
};
