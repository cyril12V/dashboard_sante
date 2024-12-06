<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToGoalsTable extends Migration
{
    public function up()
    {
        
    }

    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'status']);
        });
    }
}
