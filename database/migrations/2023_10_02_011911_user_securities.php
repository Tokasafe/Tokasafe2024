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
        Schema::create('user_securities', function (Blueprint $table) {
            $table->id();
            $table->string('workflow');
            $table->unsignedBigInteger('workgroup_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('workgroup_id')->references('id')->on('workgroups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('people')->onDelete('cascade');
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
        Schema::dropIfExists('user_securities');
    }
};
