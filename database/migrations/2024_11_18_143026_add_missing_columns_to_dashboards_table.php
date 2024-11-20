<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToDashboardsTable extends Migration
{
    public function up()
    {
        Schema::table('dashboards', function (Blueprint $table) {
            $table->json('heart_rate_data')->nullable()->after('sleep_quality');
            $table->json('activity_data')->nullable()->after('heart_rate_data');
        });
    }

    public function down()
    {
        Schema::table('dashboards', function (Blueprint $table) {
            $table->dropColumn(['heart_rate_data', 'activity_data']);
        });
    }
}

