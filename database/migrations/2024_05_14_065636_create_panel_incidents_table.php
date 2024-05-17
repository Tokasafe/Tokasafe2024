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
        Schema::create('panel_incidents', function (Blueprint $table) {
            $table->id();
            $table->string('moderator_report')->nullable();
            $table->unsignedBigInteger('assignTo')->nullable();
            $table->unsignedBigInteger('also_assignTo')->nullable();
            $table->unsignedBigInteger('workflow_step')->nullable();
            $table->unsignedBigInteger('incident_report_id')->nullable();
            $table->foreign('assignTo')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('workflow_step')->references('id')->on('workflow_new')->onDelete('cascade');
            $table->foreign('also_assignTo')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('incident_report_id')->references('id')->on('incident_reports')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panel_incidents');
    }
};
