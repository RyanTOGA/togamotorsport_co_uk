<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('race_sessions');
            $table->string('track_name');
            $table->string('turn_number');
            $table->integer('your_race_number');
            $table->integer('offending_car_race_number');
            $table->longText('video_link');
            $table->longText('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incident_reports', function (Blueprint $table) {
            $table->dropForeign('session_id');
            $table->dropIfExists('session_id');
        });


        Schema::dropIfExists('incident_reports');
    }
};
