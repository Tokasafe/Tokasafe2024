<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_hazard_ids', function (Blueprint $table) {
            $table->id();
            $table->string('moderator_report')->nullable();
            $table->unsignedBigInteger('assignTo')->nullable();
            $table->unsignedBigInteger('also_assignTo')->nullable();
            $table->unsignedBigInteger('workflow_step')->nullable();
            $table->unsignedBigInteger('hazard_id')->nullable();
            $table->foreign('assignTo')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('workflow_step')->references('id')->on('workflow_new')->onDelete('cascade');
            $table->foreign('also_assignTo')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('hazard_id')->references('id')->on('hazard_ids')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panel_hazard_ids');
    }
};
