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
        Schema::create('event_actions', function (Blueprint $table) {
            $table->id();
            $table->text('report')->nullable();
            $table->text('followup_action')->nullable();
            $table->text('actionee_comments')->nullable();
            $table->text('action_condition')->nullable();
            $table->date('due_date')->nullable();
            $table->date('competed')->nullable();
            $table->unsignedBigInteger('event_hzd_id')->nullable();
            $table->foreign('event_hzd_id')->references('id')->on('hazard_ids')->onDelete('cascade');
            $table->unsignedBigInteger('responsibility')->nullable();
            $table->foreign('responsibility')->references('id')->on('people')->onDelete('cascade');
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
        Schema::dropIfExists('event_actions');
    }
};
