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
        Schema::create('workflow_new', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('destination_1')->nullable();
            $table->string('destination_2')->nullable();
            $table->string('destination_1_label')->nullable();
            $table->string('destination_2_label')->nullable();
            $table->unsignedBigInteger('status_code')->nullable();
            $table->unsignedBigInteger('responsible_role')->nullable();
            $table->foreign('status_code')->references('id')->on('status_codes')->onDelete('cascade');
            $table->foreign('responsible_role')->references('id')->on('responsible_roles')->onDelete('cascade');
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
        Schema::dropIfExists('workflow_new');
    }
};
