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
            $table->unsignedBigInteger('event_subtype')->nullable();
            $table->foreign('event_subtype')->references('id')->on('event_sub_types')->onDelete('cascade');
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
            $table->unsignedBigInteger('event_subtype')->nullable();
            $table->foreign('event_subtype')->references('id')->on('event_sub_types')->onDelete('cascade');
        });
    }
};
