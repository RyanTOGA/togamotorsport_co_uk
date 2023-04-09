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
        Schema::create('race_laps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('race_id')->unsigned();
            $table->foreign('race_id')->references('id')->on('race_sessions')->cascadeOnDelete();
            $table->integer('car_id');
            $table->integer('driver_index');
            $table->bigInteger('lap_time');
            $table->boolean('is_valid_for_best');
            $table->string('splits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('race_laps',function (Blueprint $blueprint){
            $blueprint->dropForeign('race_id');
        });
        Schema::dropIfExists('race_laps');
    }
};
