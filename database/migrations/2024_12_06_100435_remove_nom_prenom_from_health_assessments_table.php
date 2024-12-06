<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNomPrenomFromHealthAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_assessments', function (Blueprint $table) {
            // Si les colonnes nom et prénom existent, supprime-les
            $table->dropColumn(['nom', 'prenom']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_assessments', function (Blueprint $table) {
            // Restauration des colonnes si nécessaire
            $table->string('nom');
            $table->string('prenom');
        });
    }
}
