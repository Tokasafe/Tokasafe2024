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
        Schema::table('incident_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('actual_outcome')->nullable();
            $table->foreign('actual_outcome')->references('id')->on('risk_consequences')->onDelete('cascade');
            $table->unsignedBigInteger('potential_consequence')->nullable();
            $table->foreign('potential_consequence')->references('id')->on('risk_consequences')->onDelete('cascade');
            $table->unsignedBigInteger('potential_likelihood')->nullable();
            $table->foreign('potential_likelihood')->references('id')->on('risk_likelihoods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incident_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('actual_outcome')->nullable();
            $table->foreign('actual_outcome')->references('id')->on('risk_consequences')->onDelete('cascade');
            $table->unsignedBigInteger('potential_consequence')->nullable();
            $table->foreign('potential_consequence')->references('id')->on('risk_consequences')->onDelete('cascade');
            $table->unsignedBigInteger('potential_likelihood')->nullable();
            $table->foreign('potential_likelihood')->references('id')->on('risk_likelihoods')->onDelete('cascade');
        });
    }
};
