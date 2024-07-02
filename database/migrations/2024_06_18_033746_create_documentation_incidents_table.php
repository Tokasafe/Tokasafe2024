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
        Schema::create('documentation_incidents', function (Blueprint $table) {
            $table->id();
            $table->string('fileTitle');
            $table->string('fileName');
            $table->unsignedBigInteger('incident_id')->nullable();
            $table->foreign('incident_id')->references('id')->on('incident_reports')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('documentation_incidents');
    }
};
