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
        Schema::create('race_drivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('race_id')->unsigned();
            $table->foreign('race_id')->references('id')->on('race_sessions')->cascadeOnDelete();
            $table->integer('car_id');
            $table->integer('race_number');
            $table->integer('car_number');
            $table->integer('cup_cat');
            $table->string('car_group');
            $table->string('team_name')->nullable();
            $table->integer('nationality');
            $table->string('name');
            $table->string('short_name');
            $table->string('player_id');
            $table->bigInteger('best_lap');
            $table->bigInteger('total_time');
            $table->integer('lap_count');
            $table->string('best_lap_splits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('race_drivers',function (Blueprint $blueprint){
            $blueprint->dropForeign('race_id');
        });
        Schema::dropIfExists('race_drivers');
    }
};
