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
        Schema::create('workflow_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventTypeId')->nullable();
            $table->foreign('eventTypeId')->references('id')->on('event_types')->onDelete('cascade');
            $table->unsignedBigInteger('workflow_template')->nullable();
            $table->foreign('workflow_template')->references('id')->on('workflow_tempaltes')->onDelete('cascade');
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
        Schema::dropIfExists('workflow_steps');
    }
};
