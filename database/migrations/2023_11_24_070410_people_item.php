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
        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('employer')->nullable();
            $table->foreign('employer')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('point_of_hire')->nullable();
            $table->foreign('point_of_hire')->references('id')->on('ports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('employer')->nullable();
            $table->foreign('employer')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('point_of_hire')->nullable();
            $table->foreign('point_of_hire')->references('id')->on('ports')->onDelete('cascade');
        });
    }
};
