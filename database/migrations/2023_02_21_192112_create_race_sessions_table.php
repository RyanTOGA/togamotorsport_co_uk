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
        Schema::create('race_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_type')->nullable();
            $table->string('track_name')->nullable();
            $table->string('server_name')->nullable();
            $table->string('best_lap')->nullable();
            $table->string('best_splits')->nullable();
            $table->boolean('is_wet')->default(0);
            $table->string('server_ip')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_sessions');
    }
};
