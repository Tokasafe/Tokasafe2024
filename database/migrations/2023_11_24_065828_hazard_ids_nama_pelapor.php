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
        Schema::table('hazard_ids', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_pelapor')->nullable();
            $table->foreign('nama_pelapor')->references('id')->on('people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hazard_ids', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_pelapor')->nullable();
            $table->foreign('nama_pelapor')->references('id')->on('people')->onDelete('cascade');
        });
    }
};
