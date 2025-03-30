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
        Schema::table('analysis_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('water_sample_id');
            $table->string('turbidity_level');
            $table->string('contamination_level');
            $table->json('raw_analysis_data');
            $table->timestamps();

            $table->foreign('water_sample_id')->references('id')->on('water_samples');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('analysis_results');
    }
};
