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
        Schema::create('manhours_registers', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('company_category')->nullable();
            $table->string('company')->nullable();
            $table->string('dept')->nullable();
            $table->string('group')->nullable();
            $table->string('role_class')->nullable();
            $table->string('manhour')->nullable();
            $table->string('manpower')->nullable();
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
        Schema::dropIfExists('manhours_registers');
    }
};
