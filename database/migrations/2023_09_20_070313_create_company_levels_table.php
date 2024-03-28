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
        Schema::create('company_levels', function (Blueprint $table) {
            $table->id();
            $table->string('level')->nullable();
            $table->unsignedBigInteger('bussiness_unit');
            $table->string('deptORcont');
            $table->foreign('bussiness_unit')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('company_levels');
    }
};
