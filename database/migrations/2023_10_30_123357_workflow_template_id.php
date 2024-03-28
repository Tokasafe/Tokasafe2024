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
        Schema::table('workflow_new', function (Blueprint $table) {
            $table->unsignedBigInteger('workflow_template')->nullable();
            $table->foreign('workflow_template')->references('id')->on('workflow_tempaltes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workflow_new', function (Blueprint $table) {
            $table->unsignedBigInteger('workflow_template')->nullable();
            $table->foreign('workflow_template')->references('id')->on('workflow_tempaltes')->onDelete('cascade');
        });
    }
};
