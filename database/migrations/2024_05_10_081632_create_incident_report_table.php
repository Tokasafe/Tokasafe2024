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
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_type');
            $table->foreign('event_type')->references('id')->on('event_types')->onDelete('cascade');
            $table->unsignedBigInteger('sub_type');
            $table->foreign('sub_type')->references('id')->on('event_sub_types')->onDelete('cascade');
            $table->unsignedBigInteger('workgroup_id');
            $table->foreign('workgroup_id')->references('id')->on('workgroups')->onDelete('cascade');
            $table->unsignedBigInteger('reporter_name_id');
            $table->foreign('reporter_name_id')->references('id')->on('people')->onDelete('cascade');
            $table->unsignedBigInteger('report_to_id');
            $table->foreign('report_to_id')->references('id')->on('people')->onDelete('cascade');
            $table->unsignedBigInteger('location');
            $table->foreign('location')->references('id')->on('event_locations')->onDelete('cascade');
            $table->date('date_event')->nullable();
            $table->string('time_event')->nullable();
            $table->string('potential_lti')->nullable();
            $table->string('env_incident')->nullable();
            $table->string('task')->nullable();
            $table->text('description_incident')->nullable();
            $table->text('involved_person')->nullable();
            $table->text('involved_equipment')->nullable();
            $table->text('preliminary_causes')->nullable();
            $table->text('imediate_action_taken')->nullable();
            $table->text('key_learning')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
    }
};
