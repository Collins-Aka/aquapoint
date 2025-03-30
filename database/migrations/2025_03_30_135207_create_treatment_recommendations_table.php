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
        Schema::create('treatment_recommendations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('analysis_result_id')->index();
            $table->text('recommended_treatment');
            $table->text('educational_content');
            $table->timestamps();

            $table->foreign('analysis_result_id')->references('id')->on('analysis_results');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_recommendations');
    }
};
