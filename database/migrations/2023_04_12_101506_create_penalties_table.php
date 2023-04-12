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
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_report_id');
            $table->foreign('incident_report_id')->references('id')->on('incident_reports')->onDelete('CASCADE');
            $table->integer('time_penalty')->nullable();
            $table->text('penalty_comments');
            $table->boolean('is_penalty')->default(0);
            $table->boolean('is_warning')->default(0);
            $table->boolean('is_no_action')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
