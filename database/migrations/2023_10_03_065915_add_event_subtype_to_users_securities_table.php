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
        Schema::table('user_securities', function (Blueprint $table) {
            $table->unsignedBigInteger('event_sub_types_id');
            $table->foreign('event_sub_types_id')->references('id')->on('event_sub_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_securities', function (Blueprint $table) {
            $table->unsignedBigInteger('event_sub_type_id');
            $table->foreign('event_sub_type_id')->references('id')->on('event_sub_types')->onDelete('cascade');
        });
    }
};
