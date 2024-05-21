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
        Schema::create('incident_actions', function (Blueprint $table) {
            $table->id();
            $table->text('description_incident')->nullable();
            $table->text('followup_action')->nullable();
            $table->text('actionee_comments')->nullable();
            $table->text('action_condition')->nullable();
            $table->date('orginal_dueDate')->nullable();
            $table->date('dueDate')->nullable();
            $table->date('completion_date')->nullable();
            $table->date('personal_reminder')->nullable();
            $table->unsignedBigInteger('incident_report_id')->nullable();
            $table->foreign('incident_report_id')->references('id')->on('incident_reports')->onDelete('cascade');
            $table->unsignedBigInteger('responsibility')->nullable();
            $table->foreign('responsibility')->references('id')->on('people')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_actions');
    }
};
