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
            $table->unsignedBigInteger('pengawas_area')->nullable();
            $table->foreign('pengawas_area')->references('id')->on('people')->onDelete('cascade');
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
            $table->unsignedBigInteger('pengawas_area')->nullable();
            $table->foreign('pengawas_area')->references('id')->on('people')->onDelete('cascade');
        });
    }
};
